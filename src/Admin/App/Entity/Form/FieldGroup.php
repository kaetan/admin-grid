<?php

namespace App\Entity\Form;

use App\Models\ModelAbstract;

/**
 * Класс, представляющий из себя группу полей формы
 * Class FieldGroup
 */
class FieldGroup extends Renderable
{
    /**
     * @param array $fields
     * @param string $name
     * @param array $options
     */
    public function __construct(protected array $fields, protected string $name = '', array $options = [])
    {
        $this->initOptions($options);
    }

    public function render($params = []): string
    {
        return view('_partials.form.field-group', $this->getViewParams())->render();
    }

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), ['fields' => $this->fields]);
    }

    public function setFields(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function setRow(ModelAbstract $row): static
    {
        parent::setRow($row);

        foreach ($this->fields as &$field) {
            /** @var Field $field */
            $field->setRow($row);
        }

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setNamePath(string $path): static
    {
        foreach ($this->fields as &$field) {
            /** @var Field $field */
            $field->setNamePath($path);
        }

        return parent::setNamePath($path);
    }
}
