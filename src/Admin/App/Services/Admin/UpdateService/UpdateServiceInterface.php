<?php

namespace App\Services\Admin\UpdateService;

use Illuminate\Database\Eloquent\Model;

interface UpdateServiceInterface
{
    public function setModules(): void;

    public function update(): Model;
}
