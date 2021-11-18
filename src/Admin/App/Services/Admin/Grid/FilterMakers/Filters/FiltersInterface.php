<?php

namespace App\Services\Admin\Grid\FilterMakers\Filters;

interface FiltersInterface
{
    public function getFilter(array $params = []): array;
}
