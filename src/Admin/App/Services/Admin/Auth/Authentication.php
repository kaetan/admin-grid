<?php

namespace App\Services\Admin\Auth;

use App\Exceptions\AuthException;
use App\Models\User;
use App\Services\Role\RoleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    public function auth($phone, $password): User
    {
        if (str_starts_with($phone, '+7')) {
            $phone = substr($phone, 1);
        } else if (str_starts_with($phone, '8')) {
            $phone = '7' . substr($phone, 1);
        }

        /** @var User $user */
        $user = User::query()
            ->where('phone', $phone)
            ->whereIn('role', RoleService::getStaffRoles())
            ->first();

        if (empty($user)) {
            throw new ModelNotFoundException("Телефон $phone не найден");
        }

        if (!Auth::attempt(['phone' => $phone, 'password' => $password], true)) {
            throw new AuthException('Неверный логин или пароль');
        }

        return $user;
    }

    /**
     * Выход текущего пользователя из системы
     * @return bool
     */
    public function logout()
    {
        Auth::logout();
        return true;
    }

}
