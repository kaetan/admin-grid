<?php

namespace App\Services\OptionsGetter;

/**
 * Интерфейс опций
 * Interface SelectOptionsInterface
 * @package App\Entities\Form
 */
interface OptionsInterface
{
    /**
     * Получает опции
     * @return array
     */
    public function getOptions(): array;
}
