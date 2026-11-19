<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class CheckSingleSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = Session::getId();
            
            $userIp = $request->ip(); 
            $computerName = gethostbyaddr($userIp);

            $currentPC = Auth::user()->u_ad_pc_name === $computerName;

            // Log::info('пользователь', ['computerName' => $computerName, 'userip' => $userIp, 'Remembered' => Auth::viaRemember(), 'AutorizedOnHisOwnPC' => $currentPC]);

            // Если ID сессии не совпадает с сохраненным в БД
            //Auth::viaRemember() && $user->u_ad_pc_name === $computerName
            if (Auth::viaRemember() || Auth::user()->u_ad_pc_name === $computerName) {
                // Просто обновляем ID сессии в базе данных на новый
                $user->current_session_id = $currentSessionId;
                $user->save();
            } 
            else if ($user->current_session_id !== $currentSessionId) {
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
        
        
        return $next($request);
    }
}
