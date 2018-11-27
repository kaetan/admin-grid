<?php

namespace Estaticzz\AdminGrid;

class Grid
{
    public $page = 1;
    public $primary = 'id';
    public $order = 'id-desc';
    public $columns = [];
    public $actions = [];
    public $massActions = [];
    public $actionsClass = null;
    public $params = [];
    public $sizes = [
        10, 20, 30, 50, 100, 200, 'all'
    ];
    public $items = null;
    public $modelClass;
    public $model;
    public $subRowContent;
    public $filterFunction;
    public $filters = [];
    public $showSelectColumn = true;
    public $showPaginator = true;
    public $pageSize = 20;
    public $fixed = false;
    public $addUrl = false;
    public $sortable = true;
    private $tableClass = null;
    private $rowClass = null;
    private $groupFunction = null;

    const SORT_DELIMITER = '-';
    public static $sortDefault = 'id-desc';
    public static $showDashOnEmpty = false;

    const COLUMN_TYPE_BOOLEAN = 'boolean';
    const COLUMN_TYPE_STRING = 'string';
    const COLUMN_TYPE_SELECT = 'select';
    const COLUMN_TYPE_CHECKBOX = 'checkbox';

    const PAGINATION_OFFSET = 4;

    public function __construct($modelOrItems = '', $cols = [], $actions = [], $params = [], $order = null)
    {
        if (is_a($modelOrItems, 'Illuminate\Database\Eloquent\Collection')) {
            $this->items = $modelOrItems;
        } else if (is_array($modelOrItems)) {
            $this->items = collect($modelOrItems);
        } else if (is_string($modelOrItems)) {
            $this->modelClass = $modelOrItems;
            $this->model = new $modelOrItems;
        } else {
            $this->model = $modelOrItems;
        }

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

    public function getActionsClass()
    {
        return $this->actionsClass;
    }

    public function setActionsClass($class)
    {
        $this->actionsClass = $class;
        return $this;
    }

    public function getMassActions()
    {
        return $this->massActions;
    }

    public function addMassAction($action)
    {
        $this->massActions[] = $action;
        return $this;
    }

    public function setMassActions($actions)
    {
        $this->massActions = $actions;
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
        $sort = request('sort', self::$sortDefault);
        return new Sort($sort);
    }

    public static function setDefaultSort($value)
    {
        self::$sortDefault = $value;
    }

    public static function setDefaultShowDash($value)
    {
        self::$showDashOnEmpty = $value;
    }

    public function getPaginator()
    {
        // TODO: ability to transfer own paginator
        if (!$this->model) {
            return;
        }

        $sort = $this->getSort();
        $size = $this->getPageSize();

        $query = clone $this->model;
        $params = request()->all();

        unset($params['size']);
        unset($params['page']);
        unset($params['sort']);

        // Если для грида определена своя функция фильтрации, то остальные правила не учитываем
        // TODO: это старый вариант и от него можно отказаться в пользу отдельный правил фильтрации по колонкам или параметрам реквеста
        if ($this->filterFunction) {
            $query = ($this->filterFunction)($query, $params, $this);
        } else {
            foreach ($params as $param => $value) {

                $value = trim($value);
                if (($value === '') || ($value === null)) {
                    continue;
                }

                $column = $this->getColumnByCode($param);

                // Сначала проверяем наличие правила фильтрации по параметру из реквеста
                if ($filter = $this->getFilterByParam($param)) {

                    $query = ($filter)($query, $param, $value, $this);

                // Далее проверяем наличие правила фильтрации по названию колонки
                } else if ($column && $column->hasFilterFunction()) {

                    $query = ($column->getFilterFunction())($query, $value);

                // В противном случае просто накладываем условие точного соответствия значения при наличии такой колонки
                } else {
                    if ($this->model->hasField($param)) {
                        $query = $query->where($param, $value);
                    }
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

        if ($this->groupFunction) {
            $query = ($this->groupFunction)($query);
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
            'rows' => $this->items ?: $paginator->items(),
            'columns' => $this->getColumns(),
            'actions' => $this->getActions(),
            'massActions' => $this->getMassActions(),
            'sizes' => $this->sizes,
            'grid' => $this,
            'showSelectColumn' => $this->showSelectColumn,
            'showPaginator' => $this->showPaginator,
            'fixed' => $this->fixed,
            'addUrl' => $this->addUrl,
            'sortable' => $this->sortable,
            'showDashOnEmpty' => self::$showDashOnEmpty,
            'tableClass' => $this->tableClass,
            'rowClass' => $this->rowClass,
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
     * TODO: старый вариант, можно отказаться от него
     * @return null
     */
    public function setFilterFunction($function)
    {
        $this->filterFunction = $function;
        return $this;
    }

    /**
     * Возвращает функцию-фильтрацию по парамметру
     * @param $param
     * @return mixed|null
     */
    public function getFilterByParam($param)
    {
        return isset($this->filters[$param]) ? $this->filters[$param] : null;
    }

    /**
     * Добавлеет функцию-фильтрацию по парамметру
     * @param $param
     * @param $function
     * @return $this
     */
    public function addFilter($param, $function)
    {
        $this->filters[$param] = $function;
        return $this;
    }

    /**
     * Задает отдельные функции фильтрации по парметрам
     * @param $param
     * @param $function
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
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

    public function addAddUrl($url)
    {
        $this->addUrl = $url;
        return $this;
    }

    public function setSortable($sortable)
    {
        $this->sortable = $sortable;
        return $this;
    }

    public function isSortable()
    {
        return (bool)$this->sortable;
    }

    public function setTableClass($class)
    {
        $this->tableClass = $class;
        return $this;
    }

    public function setRowClass($class)
    {
        $this->rowClass = $class;
        return $this;
    }

    /**
     * Задаем параметр для групировки по полю
     * @param $groupFunction
     * @return $this
     */
    public function setGroupBy($groupFunction)
    {
        $this->groupFunction = $groupFunction;
        return $this;
    }
}