<?php

namespace App\Services\Admin\FieldServices;

use Illuminate\View\View;

class TabbedFieldServiceTab
{
    public function __construct(
        private string $code,
        private array $fields = [],
        private View|null $view = null,
        private array $options = []
    )
    {
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return View|null
     */
    public function getView(): ?View
    {
        return $this->view;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

}
