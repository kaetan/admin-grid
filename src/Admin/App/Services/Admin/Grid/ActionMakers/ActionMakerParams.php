<?php

namespace App\Services\Admin\Grid\ActionMakers;

class ActionMakerParams
{
    /**
     * @param bool $needStatusActions Нужно ли создавать действия для манипуляций со статусом
     * @param bool $needEditAction Нужно ли создавать действие редактирования
     * @param bool $needBlockAction Нужно ли создавать действие блокировки/разблокировки
     * @param bool $needDeleteAction Нужно ли создавать действие "Удалить"
     */
    public function __construct(
        private bool $needStatusActions = true,
        private bool $needEditAction = false,
        private bool $needBlockAction = false,
        private bool $needDeleteAction = false
    )
    {
    }

    /**
     * @return bool
     */
    public function isNeedStatusActions(): bool
    {
        return $this->needStatusActions;
    }

    /**
     * @return bool
     */
    public function isNeedEditAction(): bool
    {
        return $this->needEditAction;
    }

    /**
     * @return bool
     */
    public function isNeedBlockAction(): bool
    {
        return $this->needBlockAction;
    }

    /**
     * @return bool
     */
    public function isNeedDeleteAction(): bool
    {
        return $this->needDeleteAction;
    }

}
