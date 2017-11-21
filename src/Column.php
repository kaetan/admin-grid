<?php

namespace Estaticzz\AdminGrid;

class Column
{
    public $title;
    public $code;
    public $type = Grid::COLUMN_TYPE_STRING;
    public $sortable = 'desc';
    public $editable = false;
    public $formatFunction = null;
    public $sortFunction = null;
    public $class;
    public $style;
    public $hide;

    public function __construct($codeOrOptions, $title = '', $sortable = 'desc', $editable = false, $type = Grid::COLUMN_TYPE_STRING)
    {
        if (is_array($codeOrOptions)) {
            $this->setOptions($codeOrOptions);
            return;
        }

        $code = $codeOrOptions;
        $this->title = $title;
        $this->code = $code;
        $this->sortable = $sortable;
        $this->editable = (bool)$editable;
        $this->type = $type;
    }

    /**
     * @return null
     */
    public function setOptions($options)
    {
        foreach ($options as $option => $value) {
            $this->{$option} = $value;
        }
    }

    public function setFormatFunction($function)
    {
        $this->formatFunction = $function;
        return $this;
    }

    public function setTypeBoolean()
    {
        $this->type = Grid::COLUMN_TYPE_BOOLEAN;
        return $this;
    }

    public function getValue($row)
    {
        if ($this->formatFunction) {
            return ($this->formatFunction)($row);
        }

        $value = $row->{$this->code};

        switch ($this->type) {
            case Grid::COLUMN_TYPE_BOOLEAN:
                if ($value === 'Y' || $value === '1' || $value === 1 || $value === true) {
                    return '<i class="fa fa-check text-navy"></i>';
                } else {
                    return '<i class="fa fa-minus text-warning"></i>';
                }
            case Grid::COLUMN_TYPE_SELECT:
                return '<select><option>'.$row->{$this->code}.'</option></select>';
            default:
                return $row->{$this->code};
        }
    }

    public function isSortable()
    {
        return (bool)$this->sortable;
    }

    public function getSort($current = null)
    {
        if (!$this->isSortable()) {
            return;
        }

        $direction = $this->sortable;
        if ($current) {
            if ($current == 'asc') {
                $direction = 'desc';
            } else {
                $direction = 'asc';
            }
        }

        return $this->code . Sort::DELIMITER . $direction;
    }

    public function hasSortFunction()
    {
        return (bool)$this->getSortFunction();
    }

    public function getSortFunction()
    {
        return $this->sortFunction;
    }

    public function setSortFunction($function)
    {
        $this->sortFunction = $function;
        return $this;
    }

    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    public function getStyle()
    {
        return $this->style;
    }
}