<?php

namespace App\Extensions\Grid;

class Action extends \Estaticzz\AdminGrid\Action
{
    public string $attributes;

    private \Closure|null $modal = null;
    private bool $confirm = false;
    private string $confirmMessage = '';

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): static
    {
        $attrString = '';

        foreach ($attributes as $name => $value) {
            $attrString .= $name . '="' . $value . '"';
        }

        $this->attributes = $attrString;

        return $this;
    }

    public function getAttributes(): string
    {
        return $this->attributes;
    }

    /**
     * @param \Closure $modal
     * @return $this
     */
    public function setModal(\Closure $modal): static
    {
        $this->modal = $modal;
        return $this;
    }

    public function hasModal(): bool
    {
        return (bool)$this->modal;
    }

    public function getModal($row)
    {
        $modalFunc = $this->modal;

        return $modalFunc($row);
    }

    /**
     * Нужно ли подтверждать действие
     * @return bool
     */
    public function needConfirm(): bool
    {
        return $this->confirm;
    }

    /**
     * Задает свойство необходимости подтверждать действие
     * @param bool $confirm
     * @return $this
     */
    public function setConfirm(bool $confirm): static
    {
        $this->confirm = $confirm;
        return $this;
    }

    /**
     * Получает сообщение подтверждения
     * @return string|null
     */
    public function getConfirmMessage(): ?string
    {
        return $this->confirmMessage;
    }

    /**
     * Задает сообщение подтверждения
     * @param string $confirmMessage
     * @return $this
     */
    public function setConfirmMessage($confirmMessage): static
    {
        $this->confirmMessage = $confirmMessage;
        return $this;
    }
}
