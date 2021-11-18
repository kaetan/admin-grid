<?php

namespace App\Services\Role;

use App\Models\User;

class RoleService
{
    public static function getStaffRoles(): array
    {
        //TODO: если вдруг будут кастомные роли, создаваемые в админке, то мержим их к базовым ролям
        return [User::ROLE_ADMINISTRATOR, User::ROLE_OPERATOR];
    }
}
