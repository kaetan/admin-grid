<?php

namespace App\Services\Admin\Grid\ColumnMakers\FormatFunctions;

use App\Models\User;

class UserRole implements FormatFunctionInterface
{
    public static function getFormatFunction(): \Closure
    {
        return function (User $row) {
            return $row->getRoleName();
        };
    }

}
