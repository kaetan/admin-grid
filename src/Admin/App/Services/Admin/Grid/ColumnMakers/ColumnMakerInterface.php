<?php

namespace App\Services\Admin\Grid\ColumnMakers;

use Illuminate\Support\Collection;

interface ColumnMakerInterface
{
    public function makeColumns(): Collection;
}
