<?php

namespace App\Services\Permission;

use App\Models\Permission\Permission;
use App\Models\User;

class PermissionManager
{
    /**
     * Проверяет, имеет ли текущий пользователь к действию над ресурсом
     * @param string $resource
     * @param string $action
     * @param User $user
     * @return bool
     */
    public function can(string $resource, string $action, User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        $role = $user->getRole();

        $query = Permission::query()->where('role_code', $role)
            ->where('resource', $resource);

        if ($action !== Permission::ACTION_ALL) {
            $query->whereIn('action', [$action, Permission::ACTION_ALL]);
        } else {
            $query->where('action', $action);
        }

        return $query->exists();
    }

}
