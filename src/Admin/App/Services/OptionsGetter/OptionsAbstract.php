<?php

namespace App\Services\OptionsGetter;

use App\Models\ModelAbstract;

abstract class OptionsAbstract implements OptionsInterface
{
    protected ModelAbstract|null $row        = null;
    protected array              $parameters = [];

    /**
     * @param ModelAbstract $row
     * @return $this
     */
    public function setRow(ModelAbstract $row): static
    {
        $this->row = $row;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;

        return $this;
    }
}
