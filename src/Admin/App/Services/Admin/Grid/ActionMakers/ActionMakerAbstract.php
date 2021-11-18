<?php

namespace App\Services\Admin\Grid\ActionMakers;

use App\Extensions\Grid\Action;
use App\Models\ModelAbstract;
use App\Models\User;

abstract class ActionMakerAbstract implements ActionMakerInterface
{
    /**
     * @param ModelAbstract $model
     * @param ActionMakerParams $params
     * @param User $user
     */
    public function __construct(protected ModelAbstract $model, protected ActionMakerParams $params, protected User $user)
    {
    }

    /**
     * @return array
     */
    function makeActions(): array
    {
        $actions = [];

        if ($this->params->isNeedEditAction()) {
            $actions[] = with(new Action('Редактировать', function (ModelAbstract $row) {
                return $row->getEditUrl();
            }));
        }

        if ($this->params->isNeedDeleteAction()) {
            $actions[] = $this->makeDeleteAction();
        }

        return $actions;
    }

    /**
     * @return array
     */
    function makeMassActions(): array
    {
        return [];
    }

    /**
     * @return Action
     */
    protected function makeDeleteAction(): Action
    {
        return with(new Action('Удалить', function (ModelAbstract $row) {
            return $row->getDeleteUrl();
        }))->setAttributes(['action' => 'agree']);
    }

    /**
     * @return Action
     */
    protected function makeMassDeleteAction(): Action
    {
        return with(new Action('Удалить', $this->model->getMassDeleteUrl()));
    }

    /**
     * @return ModelAbstract
     */
    public function getModel(): ModelAbstract
    {
        return $this->model;
    }

    /**
     * @return ActionMakerParams
     */
    public function getParams(): ActionMakerParams
    {
        return $this->params;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

}
