<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CheckInactivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');

            if ($lastActivity) {
                $inactiveTime = Carbon::now()->diffInMinutes($lastActivity);

                if ($inactiveTime > 30) {
                    Auth::logout();
                    $message = __('You have been logged out due to inactivity.');
                    session()->flush();
                    session()->flash('status', $message);
                    return redirect('/login');}
            }

            session(['last_activity' => Carbon::now()]);
        }

        return $next($request);
    }
}
