<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', config('app.locale', 'en'));

        App::setLocale($locale);

        return $next($request);
    }
}
