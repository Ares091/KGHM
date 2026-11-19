<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;


class WindowsAuthMiddleware
{
    // public function handle(Request $request, Closure $next)
    // {
    //     // Проверяем, если пользователь уже авторизован в Laravel, пропускаем
    //     if (Auth::check()) {
    //         return $next($request);
    //     }

    //     // Получаем имя пользователя от веб-сервера
    //     $remoteUser = $request->server('REMOTE_USER') ?: $request->server('AUTH_USER');

    //     if ($remoteUser) {
    //         // Очищаем логин от имени домена (если пришло "DOMAIN\ivanov", оставляем "ivanov")
    //         $username = preg_replace('/^.*\\\\/', '', $remoteUser);
    //         // Если пришло в формате "ivanov@domain.local"
    //         $username = explode('@', $username)[0];

    //         // Находим пользователя в AD по его samaccountname и автоматически авторизуем без пароля
    //         $user = Auth::guard('web')->attempt([
    //             'samaccountname' => $username,
    //             'fallback' => [
    //                 'password' => 'sso-bypass-not-used-password', 
    //             ]
    //         ], true); // true — запомнить пользователя

    //         // Если вы используете синхронизацию с БД, можно использовать обычный поиск:
    //         // $user = \App\Models\User::where('username', $username)->first();
    //         // if ($user) { Auth::login($user); }
    //     }

    //     //Log::info('Пользователь открыл подраздел', [$depName]);

    //     return $next($request);
    // }

    
    protected const DEFAULT_CLIENT_ID = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) // Добавляем тип Request
    {
        

        // dd(

            // $request->server('REMOTE_USER'),
            // $request->server('AUTH_USER'),
            // $_SERVER['REMOTE_USER'] ?? null,
            // $_SERVER['AUTH_USER'] ?? null,

            // getenv('REMOTE_USER') ?: 'not set',
            // apache_getenv('REMOTE_USER') ?: 'not set'
        // );


        
        // Если уже авторизован – пропускаем
        if (Auth::check()) {
            return $next($request);
        }

        // Получаем имя пользователя из заголовков сервера
        $remoteUser = $request->server('REMOTE_USER') ?? $request->server('AUTH_USER');


        if (!$remoteUser) {
            // Если не удалось получить пользователя – пусть идёт как гость
            return $next($request);
        }

        // Извлекаем логин (без домена)
        $username = explode('\\', $remoteUser)[1] ?? explode('@', $remoteUser)[0];

        // Проверяем членство в группах AD
        $isAdmin = $this->userIsInAdGroup($username, 'admin');
        $isDirector = $this->userIsInAdGroup($username, 'director');
        $fullName = $this->getUserFullNameFromAd($username);

        // Определяем роль
        if ($isAdmin) {
            $role = 'admin';
        } elseif ($isDirector) {
            $role = 'director';
        } else {
            $role = 'user';
        }

        // Ищем пользователя в локальной БД по логину
        $user = User::where('u_login', $username)->first();

        if ($user) {
            // Обновляем данные при каждом входе
            $user->u_ad_user_name = $fullName ?? $username;
            $user->u_ad_pc_name = gethostname();
            $user->u_role = $role;
            $user->u_authorized = true;
            $user->u_sync_AD = true;
            $user->u_updated_at = now();
            $user->save();
        } else {
            // Создаём нового пользователя
            $user = User::create([
                'u_t_client_id' => self::DEFAULT_CLIENT_ID,
                'u_login' => $username,
                'u_password' => bcrypt(Str::random(16)), // генерируем случайный пароль
                'u_email' => null,
                'u_ad_user_name' => $fullName ?? $username,
                'u_ad_pc_name' => gethostname(),
                'u_role' => $role,
                'u_authorized' => true,
                'u_sync_AD' => true,
                'u_disabled' => false,
                'u_sync_1c' => true,
                'u_updated_at' => now(),
                'u_created_at' => now(),
            ]);
        }

        // Если пользователь заблокирован – не пускаем
        if ($user->u_disabled) {
            Log::warning("Попытка входа заблокированного пользователя: $username");
            return redirect('/')->with('error', 'Ваша учётная запись отключена.');
        }

        // Авторизуем пользователя в Laravel
        Auth::login($user);

        // Сохраняем данные в сессию
        session([
            'username' => $username,
            'full_name' => $user->u_ad_user_name,
            'pc_name' => gethostname(),
            'role' => $user->u_role,
        ]);

        // Перенаправляем в зависимости от роли
        if ($user->u_role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->u_role === 'director') {
            return redirect()->route('director.dashboard');
        }

        // Если обычный пользователь – пусть идёт на главную
        return redirect('/');
    }

    /**
     * Проверка членства пользователя в группе AD.
     */
    private function userIsInAdGroup(string $username, string $groupName): bool
    {
        try {
            $user = AdUser::where('sAMAccountName', $username)->first();
            if (!$user) {
                return false;
            }
            // Проверяем с учётом вложенности (recursive = true)
            return $user->groups()->exists($groupName, true);
        } catch (\Exception $e) {
            Log::error("Ошибка при проверке группы AD: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Получение полного имени пользователя из AD.
     */
    private function getUserFullNameFromAd(string $username): ?string
    {
        try {
            $user = AdUser::where('sAMAccountName', $username)->first();
            if (!$user) {
                return null;
            }
            return $user->getFirstAttribute('cn') ?? $user->getFirstAttribute('displayName');
        } catch (\Exception $e) {
            Log::error("Ошибка при получении имени из AD: " . $e->getMessage());
            return null;
        }
    }
}