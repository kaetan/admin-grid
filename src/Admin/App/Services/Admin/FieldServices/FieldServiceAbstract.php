<?php

namespace App\Services\Admin\FieldServices;

use App\Models\ModelAbstract;

abstract class FieldServiceAbstract implements FieldServiceInterface
{
    protected ModelAbstract|null $row = null;

    /**
     * @param ModelAbstract|null $row
     * @return $this
     */
    public function setRow(ModelAbstract|null $row = null): static
    {
        $this->row = $row;

        return $this;
    }

}
