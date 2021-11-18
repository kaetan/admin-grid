<?php

namespace App\Services\Admin\Grid\ColumnMakers\FormatFunctions;

use App\Models\ModelAbstract;

class DefaultID implements FormatFunctionInterface
{
    public static function getFormatFunction(): \Closure
    {
        return function (ModelAbstract $row) {
            return '<a href="' . $row->getEditUrl() . '">' . $row->getId() . '</a>';
        };
    }

}
