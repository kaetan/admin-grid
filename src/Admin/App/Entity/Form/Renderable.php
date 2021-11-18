<?php

namespace App\Entity\Form;

use App\Models\ModelAbstract;

/**
 * Класс отображаемой сущности
 * Class Renderable
 */
class Renderable
{
    const VIEW_TITLE_WIDTH = 4;
    const VIEW_FIELD_WIDTH = 8;

    /**
     * Объекты
     */
    protected ModelAbstract|null $row = null;

    /**
     * Простые поля
     */
    protected bool $isHtml = false;
    protected array $options = [];
    protected string $namePath = '';
    protected string $name = '';
    protected string $view = '_partials.form.field';
    public mixed $fieldWidth;
    public mixed $titleWidth;

    /**
     * Инициализирует параметры поля
     * @param array $options
     * @return $this
     */
    protected function initOptions(array $options): static
    {
        // Опции, которые обязательно будут переданы во вьюшку, чтобы не проверять там на empty
        $requiredOptions = ['class', 'title'];

        foreach ($requiredOptions as $option) {
            if (empty($options[$option])) {
                $options[$option] = null;
            }
        }

        if (isset($options['fieldWidth'])) {
            $this->fieldWidth = $options['fieldWidth'];
        }

        if (isset($options['titleWidth'])) {
            $this->titleWidth = $options['titleWidth'];
        }

        $this->options = $options;

        return $this;
    }

    /**
     * Отрисовывает поле
     *
     * @param array $params
     * @return string
     */
    public function render(array $params = []): string
    {
        if (isset($params['fieldWidth']) && isset($this->getViewParams()['fieldWidth'])) {
            unset($params['fieldWidth']);
        }

        return view($this->view, array_merge($this->getViewParams(), $params))->render();
    }

    /**
     * Устанавливать вьюшку поля
     * @param string $view
     * @return $this
     */
    public function setView(string $view): static
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setNamePath(string $path): static
    {
        $this->namePath = $path;
        return $this;
    }

    /**
     * Получает имя(name/code) поля
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Получает название(title) поля
     * @return mixed
     */
    public function getTitle()
    {
        return $this->options['title'];
    }

    /**
     * Получает параметры отображения
     * @return array
     */
    protected function getViewParams(): array
    {
        return array_merge([
            'name' => $this->getNameForView(),
            'row' => $this->row,
            'titleWidth' => defined('VIEW_TITLE_WIDTH') ? VIEW_TITLE_WIDTH : self::VIEW_TITLE_WIDTH,
            'fieldWidth' => defined('VIEW_FIELD_WIDTH') ? VIEW_FIELD_WIDTH : self::VIEW_FIELD_WIDTH,
        ], $this->options);
    }

    /**
     * Получает название поля для вьюшки
     * @return string
     */
    protected function getNameForView(): string
    {
        if ($this->namePath) {
            $namePathSplit = explode('.', $this->namePath);
            $name = array_shift($namePathSplit);

            $lastPathEl = array_pop($namePathSplit);
            $namePathLastElement = ($lastPathEl ? '[' . $lastPathEl . ']' : '');
            $name .= implode('][', $namePathSplit) . $namePathLastElement . '[' . $this->name . ']';
        } else {
            $name = $this->name;
        }

        return $name;
    }

    /**
     * Задает объект из которого выводить данные
     * @param ModelAbstract $row
     */
    public function setRow(ModelAbstract $row): static
    {
        $this->row = $row;

        return $this;
    }

    /**
     * Получает опцию по коду
     * @param $option
     * @return mixed|null
     */
    public function getOption($option)
    {
        return $this->options[$option] ?? null;
    }

    /**
     * Задает опцию поля
     * @param string $option
     * @param mixed $value
     * @return $this
     */
    public function setOption(string $option, mixed $value): static
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->isHtml;
    }

    /**
     * @param bool $isHtml
     * @return static
     */
    public function setIsHtml(bool $isHtml): static
    {
        $this->isHtml = $isHtml;

        return $this;
    }
}
