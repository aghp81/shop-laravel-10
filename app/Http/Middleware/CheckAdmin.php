<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user(); // کاربری که لاگین کرده در حال حاضر رو برمیگردونه.
        if ( $user && $user->role == 'admin' ) {
            
            return $next($request); // همه چی اوکیه برو مرحله بعد
        }else{
            abort(403); // هلپر لاراول برای لغو همه چی
            // 403 = شما دسترسی این بخش رو ندارید.
        }
    }
}
