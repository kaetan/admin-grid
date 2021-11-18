<?php

namespace App\Services\Admin\FieldServices;


/**
 * Интерфейс классов генерации полей форм
 * Interface FieldServiceInterface
 */
interface FieldServiceInterface
{
    public function getFields(): array;
}
