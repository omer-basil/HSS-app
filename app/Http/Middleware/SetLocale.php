<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Default language
        $language = 'en';

        // If a language parameter is present in the request, use that as the selected language
        if ($request->has('language')) {
            $language = $request->input('language');
        }
        // Otherwise, check for a language stored in the session
        elseif (session('language')) {
            $language = session('language');
        }
        // Validate the language code and fall back to the default language if it is invalid
        if (!in_array($language, ['en', 'fr', 'de', 'es'])) {
            $language = 'en';
        }

        // Store the selected language in the session
        session(['language' => $language]);

        // Set the application language
        app()->setLocale($language);

        return $next($request);
    }

}
