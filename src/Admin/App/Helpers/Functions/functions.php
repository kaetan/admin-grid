<?php

use App\Models\ModelAbstract;
use Illuminate\Support\Arr;

require_once('rbac.php');
require_once('options.php');

/**
 * Получает значение параметра по коду поля. Если он пришел из реквеста, значит выводим его. Если нет, то выводим значение перевода
 *
 * @param string $field
 * @param ModelAbstract|null $row
 * @param mixed $default
 * @return mixed
 */
function get_value(string $field, ModelAbstract|null $row = null, mixed $default = null): mixed
{
    $params = request()->all();

    return Arr::has($params, $field) ? Arr::get($params, $field) : ($row ? $row->{$field} : $default);
}

function arrNotationToDotNotation($str): array|string
{
    return str_replace(']', '', str_replace('[', '.', $str));
}

function arrNotationWithoutDotNotation($str): array|string
{
    return str_replace(']', '', str_replace('[', '', $str));
}
