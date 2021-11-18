<?php

namespace App\Services\OptionsGetter;

use App\Models\ModelAbstract;
use App\Services\OptionsGetter\Options\Boolean;

/**
 * Получатель опций для полей формы
 * Class OptionsGetter
 * @package App\Entities\Form
 */
class OptionsGetter
{
    const BOOLEAN = Boolean::class;

    /**
     * Получение массива опций
     *
     * @param string $code
     * @param ModelAbstract|null $row
     * @param array $parameters
     * @return array
     */
    public static function getOptions(string $code, ModelAbstract|null $row = null, array $parameters = []): array
    {
        $optionsInstance = self::getInstance($code, $row, $parameters);

        return $optionsInstance->getOptions();
    }

    /**
     * Получает текст опции по её значению
     *
     * @param string $className
     * @param mixed $value
     * @param array $parameters
     * @return string|null
     */
    public static function getValue(string $className, mixed $value, array $parameters = []): ?string
    {
        $options = self::getOptions($className, parameters: $parameters);

        return $options[$value] ?? null;
    }

    /**
     * @param string $className
     * @param ModelAbstract|null $row
     * @param array $parameters
     * @return OptionsAbstract
     */
    private static function getInstance(string $className, ModelAbstract|null $row = null, array $parameters = []): OptionsAbstract
    {
        /** @var OptionsAbstract $optionsInstance */
        $optionsInstance = class_exists($className) ? new $className() : null;

        if ($row) {
            $optionsInstance->setRow($row);
        }

        $optionsInstance->setParameters($parameters);

        return $optionsInstance;
    }

}
