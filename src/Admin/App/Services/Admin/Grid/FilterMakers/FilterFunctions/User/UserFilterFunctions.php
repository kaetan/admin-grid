<?php

namespace App\Services\Admin\Grid\FilterMakers\FilterFunctions\User;

use App\Services\Admin\Grid\FilterMakers\FilterFunctions\FilterFunctionsAbstract;

class UserFilterFunctions extends FilterFunctionsAbstract
{
    protected function applyFilter($query, $param, $value)
    {
        $valueLike = '%' . $value . '%';

        return match ($param) {
            'phone' => $query->where('phone', 'like', $valueLike),
            'email' => $query->where('email', 'like', $valueLike),
        };
    }

}
