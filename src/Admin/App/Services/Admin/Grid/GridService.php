<?php

namespace App\Services\Admin\Grid;

use App\Extensions\Grid\Grid;
use App\Models\ModelAbstract;
use App\Services\Admin\Grid\ActionMakers\ActionMakerInterface;
use App\Services\Admin\Grid\ColumnMakers\ColumnMakerInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class GridService
{
    public function __construct(private Grid $grid, private ActionMakerInterface $actionMaker)
    {
    }

    /**
     * Задает класс, который будет создавать действия над объектами
     * @param ActionMakerInterface $actionMaker
     */
    public function setActionMaker(ActionMakerInterface $actionMaker)
    {
        $this->actionMaker = $actionMaker;
    }

    /**
     * Создает стандартную группу кнопок-экшнов для редактирования объекта
     */
    public function makeEditActions()
    {
        return $this->actionMaker->makeActions();
    }

    /**
     * Создает массовые действия над объектами
     * @return array
     */
    public function makeMassEditActions()
    {
        return $this->actionMaker->makeMassActions();
    }

    /**
     * Задает действия изменения объектов
     */
    public function setEditActions()
    {
        $this->grid->setActions($this->makeEditActions());
        $this->grid->setMassActions($this->makeMassEditActions());
    }

    /**
     * Добавляет действие/я изменения объектов
     * @param $actions
     */
    public function addEditActions($actions)
    {
        if (!is_array($actions)) {
            $this->grid->setActions(Arr::prepend($this->grid->getActions(), $actions));
        } else {
            $this->grid->setActions(array_merge($actions, $this->grid->getActions()));
        }
    }

    /**
     * @param ModelAbstract $model
     * @param bool $showFilter
     * @param ColumnMakerInterface $columnMaker
     * @return Grid
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function makeGrid(ModelAbstract $model, bool $showFilter, ColumnMakerInterface $columnMaker): Grid
    {
        $columns = $columnMaker->makeColumns();
        $grid = new Grid($model, $columns);
        $page = request()->get('page');
        $size = request()->get('size');

        if ($page) {
            $grid->setPage($page);
        }

        if ($size) {
            $grid->setPageSize($size);
        }

        $grid->setShowFilter($showFilter);

        return $grid;
    }

}
