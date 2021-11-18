<?php
use App\Services\Permission\PermissionManager;
use App\Models\User;

/**
 * @param string $resource
 * @param string $action
 * @param User $user
 * @return bool
 */
function can(string $resource, string $action, User $user): bool
{
    return (new PermissionManager())->can($resource, $action, $user);
}
