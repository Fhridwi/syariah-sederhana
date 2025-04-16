<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekAkses
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$akses)
    {
        if (Auth::check() && in_array(Auth::user()->akses, $akses)) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
    }
}
