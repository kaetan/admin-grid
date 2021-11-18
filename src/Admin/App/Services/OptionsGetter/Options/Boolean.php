<?php

namespace App\Services\OptionsGetter\Options;

use App\Services\OptionsGetter\OptionsAbstract;

class Boolean extends OptionsAbstract
{
    public function getOptions(): array
    {
        return [
            0 => 'Нет',
            1 => 'Да',
        ];
    }

}
