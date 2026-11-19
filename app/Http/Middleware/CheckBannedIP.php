<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedIP
{

    protected array $bannedIp = [
        // '192.168.138.28',
        // '192.168.138.29',
        '192.168.138.30',
        // '192.168.138.31',
        // '192.168.138.16'
    ];

    public function handle(Request $request, Closure $next)
    {
        //(Auth::user()->u_login === "urmashev.o" || Auth::user()->u_login === "vasilchenko.n") && 
        if ((Auth::user()->u_login === "urmashev.o" || Auth::user()->u_login === "vasilchenko.n") && in_array($request->ip(), $this->bannedIp)) {
            // abort(403, 'Ваш IP-адрес заблокирован.');
            return redirect('https://www.youtube.com/watch?v=pZo-WiH1dNo');
        }

        return $next($request);
    }
}
