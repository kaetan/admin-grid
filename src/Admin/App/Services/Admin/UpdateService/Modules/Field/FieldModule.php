<?php

namespace App\Services\Admin\UpdateService\Modules\Field;

use App\Services\Admin\UpdateService\Modules\UpdateModuleAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class FieldModule extends UpdateModuleAbstract
{
    public function update(): Model
    {
        $table = $this->entity->getTable();

        foreach ($this->requestData as $key => $value) {
            if (Schema::hasColumn($table, $key) && $this->entity->$key != $value && !in_array($key, $this->ignoreItems)) {
                if ($key === 'password') {
                    if (empty($value)) {
                        continue;
                    }

                    $this->entity->{$key} = Hash::make($value);
                } else {
                    $this->entity->{$key} = $value;
                }
            }
        }

        $this->entity->save();

        return $this->entity;
    }

}
