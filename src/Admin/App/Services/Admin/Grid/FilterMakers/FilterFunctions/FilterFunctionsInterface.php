<?php

namespace App\Services\Admin\Grid\FilterMakers\FilterFunctions;

interface FilterFunctionsInterface
{
    public function getFunctions(): \Closure;
}
