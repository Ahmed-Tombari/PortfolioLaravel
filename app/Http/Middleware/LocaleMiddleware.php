<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session or default to 'en'
        $locale = Session::get('locale', config('app.locale', 'en'));
        App::setLocale($locale);

        // Get RTL from session or default to false
        $rtl = Session::get('rtl', false);
        
        // Share these with all views
        view()->share('locale', $locale);
        view()->share('rtl', $rtl);

        return $next($request);
    }
}
