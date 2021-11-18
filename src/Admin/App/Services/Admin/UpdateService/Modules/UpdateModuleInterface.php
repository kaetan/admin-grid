<?php

namespace App\Services\Admin\UpdateService\Modules;

use Illuminate\Database\Eloquent\Model;

interface UpdateModuleInterface
{
    public function update(): Model;
}
