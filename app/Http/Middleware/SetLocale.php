<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $lang_short = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $lang_exists = Language::where('code', '=', $lang_short)->first();
        if (!$lang_exists) app()->setLocale(config('app.locale'));
        if ($lang_exists) app()->setLocale($lang_exists['code']);

        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        return $next($request);
    }
}