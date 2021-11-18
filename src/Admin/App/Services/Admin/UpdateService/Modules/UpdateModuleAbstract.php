<?php

namespace App\Services\Admin\UpdateService\Modules;

use Illuminate\Database\Eloquent\Model;

abstract class UpdateModuleAbstract implements UpdateModuleInterface
{
    protected array $ignoreItems = [
        '_token',
        'files',
    ];

    public function __construct(protected Model $entity, protected array $requestData)
    {
    }

    public function addIgnoreItems(array $items)
    {
        $this->ignoreItems = array_merge($this->ignoreItems, $items);
    }
}
