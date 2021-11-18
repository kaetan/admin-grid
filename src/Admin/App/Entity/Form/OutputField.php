<?php

namespace App\Entity\Form;

use App\Models\ModelAbstract;

/**
 * Класс представляющий из себя поле вывода
 * Class OutputField
 * @package App\Entities\Form
 */
class OutputField extends Renderable
{
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_SELECT = 'select';
    const TYPE_TEXT = 'text';
    const TYPE_MIN_MAX = 'min-max-value';

    protected mixed $value = null;
    protected string $view = '_partials.form.output';

    public function __construct(string $name, ModelAbstract|null $row = null, array $options = [])
    {
        $options['value'] = $options['value'] ?? $row->{$name};

        if (empty($options['value'])) {
            $options['value'] = '&mdash;';
        }

        $this->options = $options;

        $this->row = $row;
    }

    /**
     * Преобразует булевое значение к понятному пользователю представлению
     * @param $value
     * @return string
     */
    public static function prettifyBool($value): string
    {
        return $value ? 'Да' : 'Нет';
    }
}
