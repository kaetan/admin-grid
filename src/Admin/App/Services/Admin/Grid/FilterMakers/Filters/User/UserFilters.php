<?php

namespace App\Services\Admin\Grid\FilterMakers\Filters\User;

use App\Entity\Form\Filter;
use App\Services\Admin\Grid\FilterMakers\Filters\FiltersInterface;

class UserFilters implements FiltersInterface
{
    public function getFilter(array $params = []): array
    {
        return [
            (new Filter('phone', Filter::TYPE_TEXT, [
                'title' => 'Телефон',
                'class' => 'js-disable-mask',
            ])),
            (new Filter('email', Filter::TYPE_TEXT, [
                'title' => 'Email',
            ])),
        ];
    }

}
