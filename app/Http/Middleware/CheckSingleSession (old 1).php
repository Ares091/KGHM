<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CheckSingleSession
{
    public function handle($request, Closure $next)
    {
        $url = $request->url();
        $pageIsMain = $url !== 'http://handbook' ? false : true;
        Log::info('Пользователь находится по url: ', [$url]);
        Log::info('Это главная страница? : ', [$pageIsMain ]);

        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = Session::getId();
            //$pageIsMain = $request->header('referer') === 'http://handbook/' ? true : false;
            
            
            // Если ID сессии не совпадает с сохраненным в БД
            if ($user->current_session_id !== $currentSessionId) {
                // Выходим из системы
                Auth::logout();
                Session::flush();

                // Если запрос AJAX или ожидает JSON — возвращаем ошибку
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'error' => 'Сессия недействительна. Выполнен вход с другого устройства.',
                        'requires_auth' => true,
                    ], 401);
                }
                
                return redirect()->route('index')
                    ->with('error', 'Вы были автоматически выведены из системы, так как выполнен вход с другого устройства.');
            }
        }

        if ($url !== 'http://handbook' && !Auth::user()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                        'error' => 'Сессия недействительна. Выполнен вход с другого устройства.',
                        'requires_auth' => true,
                    ], 401);
            }
        }
        
        return $next($request);
    }
}
