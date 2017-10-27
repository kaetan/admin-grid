<?php

namespace Estaticzz\AdminGrid;

class Grid
{
    public $page = 1;
    public $primary = 'id';
    public $order = 'id-desc';
    public $columns = [];
    public $actions = [];
    public $params = [];
    public $tabs = [];
    public $modelClass;

    const PAGE_SIZE_DEFAULT = 20;
    const ORDER_DEFAULT = 'id-desc';

    const COLUMN_TYPE_BOOLEAN = 'boolean';
    const COLUMN_TYPE_STRING = 'string';
    const COLUMN_TYPE_SELECT = 'select';
    const COLUMN_TYPE_CHECKBOX = 'checkbox';

    public function __construct($modelClass = '', $cols = [], $actions = [], $params = [], $order = null)
    {
        $this->modelClass = $modelClass;
        $this->columns = $cols;
        $this->actions = $actions;
        $this->params = $params;

        if ($order) {
            $this->order = $order;
        }
    }

    public function setColumns($cols)
    {
        $this->columns = $cols;
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getSize()
    {
        // TODO:
        return self::PAGE_SIZE_DEFAULT;
    }

    public function getOrder($split = false)
    {
        // TODO:
        $order = self::ORDER_DEFAULT;
        if ($split) {
            $order = explode('-', $order);
            if (empty($order[1])) {
                // TODO:
            }
        }

        return $order;
    }

    public function getTabs()
    {
        return [];
    }

    public function getPaginator()
    {
        $order = $this->getOrder(true);
        $size = $this->getSize();

        return with(new $this->modelClass)->orderBy($order[0], $order[1])
            ->paginate($size);
    }

    public function render()
    {
        $paginator = $this->getPaginator();
        return view('admin-grid::grid', [
            'size' => $this->getSize(),
            'order' => $this->getOrder(),
            'rows' => $paginator->items(),
            'tabs' => $this->getTabs(),
            'columns' => $this->getColumns(),
        ])->render();
    }
}