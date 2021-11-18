<?php

namespace App\Services\Admin\Grid\ColumnMakers;

use App\Services\Admin\Grid\ColumnMakers\FormatFunctions\DefaultID;
use App\Services\Admin\Grid\ColumnMakers\FormatFunctions\UserRole;

class UsersColumnMaker extends ColumnMakerAbstract
{
    protected function getColumnParams(): array
    {
        return [
            [
                'name' => 'id',
                'title' => 'ID',
                'class' => '',
                'formatFunction' => DefaultID::getFormatFunction(),
            ],
            [
                'name' => 'phone',
                'title' => 'Телефон',
                'class' => '',
            ],
            [
                'name' => 'role',
                'title' => 'Роль',
                'class' => '',
                'formatFunction' => UserRole::getFormatFunction(),
            ],
            [
                'name' => 'email',
                'title' => 'Email',
                'class' => '',
            ],
            [
                'name' => 'first_name',
                'title' => 'Имя',
                'class' => '',
            ],
            [
                'name' => 'last_name',
                'title' => 'Фамилия',
                'class' => '',
            ],
        ];
    }
}
