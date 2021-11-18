<?php

use App\Models\ModelAbstract;
use App\Services\OptionsGetter\OptionsGetter;

function get_options(string $code, ModelAbstract|null $row = null, array $parameters = []): array
{
    return OptionsGetter::getOptions($code, $row, $parameters);
}
