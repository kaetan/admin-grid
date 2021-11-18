<?php

namespace App\Services\Admin\Grid\ActionMakers;

use App\Models\ModelAbstract;
use App\Models\User;

interface ActionMakerInterface
{
    public function __construct(ModelAbstract $model, ActionMakerParams $params, User $user);

    public function makeActions(): array;

    public function makeMassActions(): array;
}
