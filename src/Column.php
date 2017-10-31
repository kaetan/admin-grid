<?php

namespace Estaticzz\AdminGrid;

class Column
{
    public $title;
    public $code;
    public $type = Grid::COLUMN_TYPE_STRING;
    public $sortable = true;
    public $editable = false;
    public $formatFunction = null;
    public $hide;

    public function __construct($codeOrOptions, $title = '', $sortable = true, $editable = false, $type = Grid::COLUMN_TYPE_STRING)
    {
        if (is_array($codeOrOptions)) {
            $this->setOptions($codeOrOptions);
            return;
        }

        $code = $codeOrOptions;
        $this->title = $title;
        $this->code = $code;
        $this->sortable = (bool)$sortable;
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
}