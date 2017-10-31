<?php

namespace Estaticzz\AdminGrid;

class Sort
{
    public $field;
    public $direction = 'desc';

    const DELIMITER = '-';

    /**
     *
     */
    public function __construct($value)
    {
        $order = explode(self::DELIMITER, $value);
        $this->field = $order[0];
        if (!empty($order[1])) {
            $this->direction = $order[1];
        }
    }

    /**
     *
     */
    public function __toString()
    {
        return $this->field . self::DELIMITER . $this->direction;
    }
}