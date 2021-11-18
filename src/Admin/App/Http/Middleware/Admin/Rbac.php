<?php

namespace App\Http\Middleware\Admin;

use App\Models\Permission\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Rbac
{
    public function handle($request, \Closure $next)
    {
        if (Route::currentRouteName() == 'admin.logout') {
            return $next($request);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user->getRole())) {
            return abort(404);
        }

        if ($user->isAdmin()) {
            return $next($request);
        }

        $actions = [
            'view',
            'edit',
            'delete',
            'mass-delete',
            'mass-check',
            'read',
            'start'
        ];

        $routeName = Route::currentRouteName();

        foreach ($actions as $action) {
            if (!preg_match('/-'.$action.'/msi', Route::currentRouteName())) {
                continue;
            }

            $routeName = str_replace('-'.$action, '', Route::currentRouteName());
        }

        /** @var Permission $existPermission */
        $existReadPermission = Permission::query()
            ->where('role_code', $user->getRole())
            ->where('resource', $routeName)
            ->whereIn('action', [Permission::ACTION_READ, Permission::ACTION_ALL])
            ->exists();

        $existWritePermission = Permission::query()
            ->where('role_code', $user->getRole())
            ->where('resource', $routeName)
            ->whereIn('action', [Permission::ACTION_WRITE, Permission::ACTION_ALL])
            ->first();

        if (!$existReadPermission) {
            return abort(404);
        }

        if (Route::current()->getActionMethod() !== 'index' && !$existWritePermission) {
            return abort(404);
        }

        return $next($request);
    }
}
