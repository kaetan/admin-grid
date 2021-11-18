<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Routes
{
    /**
     * @param string $route
     * @param array $params
     * @return bool
     */
   public static function isCurrentRoute(string $route, array $params = []): bool
   {
        foreach ($params as $key => $routeParam) {
            $currentRouteParam = request($key);

            if ($currentRouteParam != $routeParam) {
                return false;
            }
        }
        return Str::startsWith(Route::currentRouteName(), $route);
    }

}
