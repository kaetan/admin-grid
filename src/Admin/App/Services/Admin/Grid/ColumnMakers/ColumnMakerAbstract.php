<?php

namespace App\Services\Admin\Grid\ColumnMakers;

use Estaticzz\AdminGrid\Column;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

abstract class ColumnMakerAbstract implements ColumnMakerInterface
{
    protected array $columns = [];

    public function __construct()
    {
        $this->columns = $this->getColumnParams();
    }

    /**
     * Создает колонки для грида
     * @return Collection
     */
    public function makeColumns(): Collection
    {
        $columns = collect();

        $columnsData = $this->columns;
        $columnsData = Arr::sort($columnsData, function($item) {
            return $item['order'] ?? 100;
        });

        foreach ($columnsData as $columnData) {
            /** @var Column $column */
            $column = with(new Column($columnData['name'], $columnData['title']));

            if (!empty($columnData['formatFunction'])) {
                $column->setFormatFunction($columnData['formatFunction']);
            }

            if (!empty($columnData['sortFunction'])) {
                $column->setSortFunction($columnData['sortFunction']);
            }

            if (!empty($columnData['class'])) {
                $column->setClass($columnData['class']);
            }

            if (!empty($columnData['disableSort'])) {
                $column->setSortable(false);
            }

            $columns->push($column);
        }

        return $columns;
    }

    /**
     * Выдает параметры, как формировать колонки грида
     * @return array
     */
    abstract protected function getColumnParams(): array;
}
