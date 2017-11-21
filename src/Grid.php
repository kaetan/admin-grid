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
    public $sizes = [
        10, 20, 30, 50, 100, 200, 'all'
    ];
    public $modelClass;
    public $subRowContent;
    public $filterFunction;
    public $showSelectColumn = true;
    public $showPaginator = true;
    public $pageSize = 20;
    public $fixed = false;

    const SORT_DELIMITER = '-';
    const SORT_DEFAULT = 'id-desc';

    const COLUMN_TYPE_BOOLEAN = 'boolean';
    const COLUMN_TYPE_STRING = 'string';
    const COLUMN_TYPE_SELECT = 'select';
    const COLUMN_TYPE_CHECKBOX = 'checkbox';

    const PAGINATION_OFFSET = 4;

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

    public function getActions()
    {
        return $this->actions;
    }

    public function setActions($actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function getColumnByCode($code)
    {
        $cols = $this->getColumns();
        foreach ($cols as $col) {
            if ($col->code == $code) {
                return $col;
            }
        }
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function setColumns($cols)
    {
        $this->columns = $cols;
        return $this;
    }

    public function setFixed($fixed)
    {
        $this->fixed = $fixed;
        return $this;
    }

    public function setPageSize($size)
    {
        $this->pageSize = $size;
        return $this;
    }

    public function getPageSize()
    {
        return request('size', $this->pageSize);
    }

    public function getSort()
    {
        $sort = request('sort', self::SORT_DEFAULT);
        return new Sort($sort);
    }

    public function getPaginator()
    {
        $sort = $this->getSort();
        $size = $this->getPageSize();

        $query = new $this->modelClass;

        $params = request()->all();
        unset($params['size']);
        unset($params['page']);
        unset($params['sort']);

        if ($this->filterFunction) {
            $query = ($this->filterFunction)($query, $params, $this);
        } else {

            $row = with(new $this->modelClass)->first();

            if ($row) {
                foreach ($params as $param => $value) {
                    if (!isset($row->{$param}) || ($value === '') || ($value === null)) {
                        continue;
                    }
                    $query = $query->where($param, $value);
                }
            }
        }

        if ($sort) {
            $column = $this->getColumnByCode($sort->field);

            if ($column && $column->hasSortFunction()) {
                $query = ($column->getSortFunction())($query, $sort->direction);
            } else {
                $query = $query->orderBy($sort->field, $sort->direction);
            }
        }

        return $query->paginate($size == 'all' ? 9999999999 : $size);
    }

    public function render()
    {
        $paginator = $this->getPaginator();
        return view('admin-grid::grid', [
            'paginator' => $paginator,
            'paginationOffset' => self::PAGINATION_OFFSET,
            'size' => $this->getPageSize(),
            'sort' => $this->getSort(),
            'rows' => $paginator->items(),
            'columns' => $this->getColumns(),
            'actions' => $this->getActions(),
            'sizes' => $this->sizes,
            'grid' => $this,
            'showSelectColumn' => $this->showSelectColumn,
            'showPaginator' => $this->showPaginator,
            'fixed' => $this->fixed,
        ])->render();
    }

    /**
     * Устанавливает контент внизу строки
     * @return null
     */
    public function setSubRowContent($value)
    {
        $this->subRowContent = $value;
        return $this;
    }

    /**
     * Устанавливает функцию-замыкание для сортировки
     * @return null
     */
    public function setFilterFunction($function)
    {
        $this->filterFunction = $function;
    }

    /**
     * Получает контент внизу строки
     * @return null
     */
    public function getSubRowContent($row, $i)
    {

        if (is_callable($this->subRowContent)) {
            return ($this->subRowContent)($row, $i, $this);
        }

//        return $this->subRowContent;
    }

    public function showSelectColumn($show)
    {
        $this->showSelectColumn = $show;
        return $this;
    }

    public function showPaginator($show)
    {
        $this->showPaginator = $show;
        return $this;
    }
}