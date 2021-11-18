<?php

namespace App\Http\Middleware\Admin;

use App\Entity\Rbac\Resource;
use App\Models\Permission\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, \Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user || !can(Resource::ADMIN_PANEL, Permission::ACTION_ALL, $user)) {
            abort(404);
        }

        return $next($request);
    }
}
