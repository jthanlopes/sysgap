<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      switch ($guard) {
        case 'freelancer':
        if (Auth::guard($guard)->check()) {
          return redirect()->route('freelancer.perfil');
        } elseif(Auth::guard('empresa')->check()) {
          return redirect()->route('empresa.perfil');
        }
        break;
        case 'empresa':
              // dd('teste 2');
        if (Auth::guard($guard)->check()) {
          return redirect()->route('empresa.perfil');
        } elseif(Auth::guard('freelancer')->check()) {
          return redirect()->route('freelancer.perfil');
        }
        break;

        default:
        dd('teste 3');
        if (Auth::guard($guard)->check()) {
          return redirect('admin');
        }
        break;
      }
      return $next($request);
    }
  }
