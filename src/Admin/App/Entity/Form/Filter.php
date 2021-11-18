<?php

namespace App\Entity\Form;

/**
 * Класс фильтра
 * Class Filter
 * @package App\Entities\Form
 */
class Filter extends Field
{
    /**
     * @param string $name
     * @param string $type
     * @param array $options
     */
    public function __construct(string $name, string $type = self::TYPE_TEXT, array $options = [])
    {
        parent::__construct($name, $type, $options);

        $this->view = '_partials.form.' . $this->getType();
    }
}
