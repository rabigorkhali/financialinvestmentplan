<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $currentUrl = url()->current(); // Get the current URL
        $pathParts = parse_url($currentUrl); // Parse the URL
        $redirectUrl = isset($pathParts['path']) ? $pathParts['path'] : ''; // Get the path

        $redirectUrl = str_replace('/system', '', $redirectUrl);

        if (!$request->expectsJson()) {
            $loginUrl = route('login', ['redirect' => $redirectUrl]);
            return urldecode($loginUrl);
        }
    }
}
