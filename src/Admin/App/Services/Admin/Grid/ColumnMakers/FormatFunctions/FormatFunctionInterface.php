<?php

namespace App\Services\Admin\Grid\ColumnMakers\FormatFunctions;

interface FormatFunctionInterface
{
    public static function getFormatFunction(): \Closure;
}
