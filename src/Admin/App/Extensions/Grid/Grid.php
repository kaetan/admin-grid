<?php

namespace App\Extensions\Grid;

use App\Extensions\Grid\Entity\Button;
use App\Models\ModelAbstract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class Grid extends \Estaticzz\AdminGrid\Grid
{
    private Builder|null $query = null;
    private \Closure|null $groupFunction = null;
    private \Closure|null $rowAttrFunction = null;

    private bool $actionButtonVisibility = true;
    private bool $showSearch = true;
    private bool $showFilter = true;
    private array $indexButtons = [];
    private string $table = '';
    private string|null $pagesUrl = null;

    /**
     * @param Button $button
     * @return $this
     */
    public function addIndexButton(Button $button): static
    {
        $this->indexButtons[] = $button;
        return $this;
    }

    /**
     * @return array
     */
    public function getIndexButtons(): array
    {
        return $this->indexButtons;
    }

    public function getPaginator()
    {
        // TODO: ability to transfer own paginator
        if (!$this->model) {
            return;
        }

        $sort = $this->getSort();
        $size = $this->getPageSizeAsString();
        $page = request()->get('page', 1);

        $query = $this->getFilteredQuery();

        if ($sort) {
            $column = $this->getColumnByCode($sort->field);
            if ($column && $column->hasSortFunction()) {
                $query = ($column->getSortFunction())($query, $sort->direction);
            } else {
                $sortRowName = $this->getRowTable() ? $this->getRowTable() . '.' . $sort->field : $sort->field;
                $query = $query->orderBy($sortRowName, $sort->direction);
            }
        }

        if ($this->groupFunction) {
            $query = ($this->groupFunction)($query);
        }

        $paginate = $query->paginate($size ?? 9999999999, page: $page);

        /** @var LengthAwarePaginator $paginate */
        $paginate->setCollection(collect($paginate->items()));

        return $paginate;
    }

    public function setPage(int $page): static
    {
        $this->page = $page;
        return $this;
    }

    public function setRowTable(string $table): static
    {
        $this->table = $table;
        return $this;
    }

    public function getRowTable(): ?string
    {
        return $this->table;
    }

    public function setRowAttrFunction(\Closure $function)
    {
        $this->rowAttrFunction = $function;
    }

    public function getRowAttrFunction(): ?\Closure
    {
        return $this->rowAttrFunction;
    }

    public function getActionButtonVisibility(): bool
    {
        return $this->actionButtonVisibility;
    }

    public function setActionButtonVisibility(bool $actionButtonVisibility): static
    {
        $this->actionButtonVisibility = $actionButtonVisibility;
        return $this;
    }

    public function getRowAttributes($row)
    {
        return $this->rowAttrFunction ? ($this->rowAttrFunction)($row) : null;
    }

    public function getShowSearch(): bool
    {
        return $this->showSearch;
    }

    public function getShowFilter(): bool
    {
        return $this->showFilter;
    }

    public function setShowFilter(bool $showFilter)
    {
        $this->showFilter = $showFilter;
    }

    public function setShowSearch(bool $showSearch)
    {
        $this->showSearch = $showSearch;
    }

    public function getPagesUrl(): ?string
    {
        return $this->pagesUrl;
    }

    public function setPagesUrl(string $pagesUrl): static
    {
        $this->pagesUrl = $pagesUrl;
        return $this;
    }

    public function setQuery(Builder $query): static
    {
        $this->query = $query;
        return $this;
    }

    public function getPageSizeAsString(): ?int
    {
        if (is_string($this->getPageSize()) && !is_numeric($this->getPageSize())) {
            mb_parse_str($this->getPageSize(), $params);

            $size = isset($params['size']) ? (int) $params['size'] : 20;
        } else {
            $size = (int) $this->getPageSize();
        }

        return $size;
    }

    public function getFilteredQuery(): ?Builder
    {
        if (!empty($this->query)) {
            return $this->query;
        }

        /** @var ModelAbstract $model */
        $model = $this->model;
        $query = $model::query();
        $params = request()->all();

        unset($params['size']);
        unset($params['page']);
        unset($params['sort']);

        if ($this->filterFunction) {
            $query = ($this->filterFunction)($query, $params, $this);
        }

        $this->query = $query;

        return $query;
    }
}
