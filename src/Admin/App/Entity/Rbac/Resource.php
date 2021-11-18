<?php

namespace App\Entity\Rbac;

class Resource
{
    const ADMIN_PANEL = 'admin.home';
    const USERS = 'users';

    const ALL = [
        self::ADMIN_PANEL,
        self::USERS,
    ];

    /**
     * Возвращает имя по коду
     * @param $code
     * @return string|null
     */
    public static function getName($code): ?string
    {
        $map = [
            self::ADMIN_PANEL => 'Доступ к административной панели',
            self::USERS => 'Доступ к настройкам пользователей',
        ];

        return $map[$code] ?? null;
    }
}
