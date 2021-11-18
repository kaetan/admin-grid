<?php

namespace App\Models;

use App\Models\Traits\EditableModel;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class ModelAbstract extends EloquentModel
{
    use EditableModel;

    public function getId(): ?int
    {
        return $this->id;
    }

}
