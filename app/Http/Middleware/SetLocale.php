<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada session 'locale'
        if (Session::has('locale')) {
            // Set bahasa aplikasi sesuai dengan session
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
