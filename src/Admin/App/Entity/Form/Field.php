<?php

namespace App\Entity\Form;

use Illuminate\Support\Str;

/**
 * Класс, представляющий из себя поле формы
 * Class Field
 */
class Field extends Renderable
{
    const TYPE_TEXT = 'text';
    const TYPE_HIDDEN = 'hidden';
    //TODO если не хотите ловить неубиваемое кретинское автозаполнение поля с паролем в хроме, то НЕ используйте
    // этот тип поля вообще совсем нигде. Я пробовал убить его автозаполнение, это нереально. Хром с каждым апдейтом
    // устраняет каждый работающий способ по убийству автозаполнения. Без понятия, зачем они так упарываются.
    const TYPE_PASSWORD = 'password';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_CHECKBOX_LEFT = 'checkbox-left';
    const TYPE_SELECT = 'select';
    const TYPE_LABEL = 'label';
    const TYPE_DATE_INTERVAL = 'date-interval';
    const TYPE_DATE = 'date';
    const TYPE_TIME = 'time';
    const TYPE_CUSTOM = 'custom';
    const TYPE_CLOCKPICKER = 'clockpicker';
    const TYPE_RANGE_SLIDER = 'rangeSlider';
    const TYPE_FILE = 'file';
    const TYPE_SUMMERNOTE = 'summernote';
    const TYPE_LINK_FILE = 'link-file';
    const TYPE_LOAD_FILE = 'load-file';
    const TYPE_IMAGE_UPLOAD = 'image-upload';
    const TYPE_SLIDES = 'slides';
    const TYPE_NUMBER = 'number';
    const TYPE_IMAGE_SIMPLE = 'image-simple';

    protected \Closure|null $valueFunction = null;

    public function __construct(protected string $name, protected string $type = self::TYPE_TEXT, array $options = [])
    {
        $this->initOptions($options);
    }

    /**
     * @inheritdoc
     */
    protected function initOptions(array $options): static
    {
        parent::initOptions($options);

        if ($this->type === self::TYPE_SELECT && !empty($this->options['multiple'])) {
            $class = $this->options['class'] ?? '';

            if (!Str::contains($class, 'js-chosen')) {
                $this->options['class'] = $class . ' js-chosen';
            }
        }

        return $this;
    }

    /**
     * Получает тип поля
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    protected function getViewParams(): array
    {
        $viewParams = array_merge(parent::getViewParams(), [
            'type' => $this->type,
        ]);

        $viewParams['value'] = $this->getValue();

        return $viewParams;
    }

    /**
     * Получает значение
     * @return mixed
     */
    public function getValue(): mixed
    {
        $value = get_value($this->name);

        if ($value) {
            return $value;
        }

        if (isset($this->options['value'])) {
            $value = $this->options['value'];
        } else {
            $valFunc = $this->valueFunction;
            $value = $valFunc ? $valFunc($this->row, $this->getName()) : get_value($this->name, $this->row);
        }

        return $value;
    }

    /**
     * @param \Closure $function
     * @return $this
     */
    public function setValueFunction(\Closure $function): static
    {
        $this->valueFunction = $function;

        return $this;
    }
}
