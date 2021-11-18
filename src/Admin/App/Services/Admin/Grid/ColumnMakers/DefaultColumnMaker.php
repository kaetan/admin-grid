<?php

namespace App\Services\Admin\Grid\ColumnMakers;

use App\Services\Admin\Grid\ColumnMakers\FormatFunctions\DefaultID;

class DefaultColumnMaker extends ColumnMakerAbstract
{
    protected function getColumnParams(): array
    {
        return [
            [
                'name' => 'id',
                'title' => 'ID',
                'class' => '',
                'formatFunction' => DefaultID::getFormatFunction(),
            ],
        ];
    }

}
