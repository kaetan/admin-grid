<?php

namespace App\Services\Admin\Grid\FilterMakers\FilterFunctions;

use App\Extensions\Grid\Grid;

abstract class FilterFunctionsAbstract implements FilterFunctionsInterface
{
    public function getFunctions(): \Closure
    {
        return function ($query, array $params, Grid|null $grid = null) {
            foreach ($params as $param => $value) {
                $value = is_array($value) ? $value : trim($value);

                if (empty($value) && !is_numeric($value)) {
                    continue;
                }

                $query = $this->applyFilter($query, $param, $value);
            }

            return $query;
        };
    }

    abstract protected function applyFilter($query, $param, $value);

}
