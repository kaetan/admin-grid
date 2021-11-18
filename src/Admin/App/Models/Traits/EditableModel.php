<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait EditableModel
{
    public string $routePrefix = '';

    /**
     * Получает url для редактирования сущности
     *
     * @param array $params
     * @return string
     */
    public function getEditUrl(array $params = []): string
    {
		return route($this->getRoutePrefix().'-edit', array_merge(['id' => $this->getId()], $params));
	}

    /**
     * Получает url для редактирования сущности
     *
     * @return string
     */
    public function getViewUrl(): string
    {
        return route($this->getRoutePrefix().'-view', ['id' => $this->getId()]);

    }

	/**
	 * Получает url для отключения сущности
     *
	 * @return string
	 */
	public function getDisableUrl(): string
	{
		return route($this->getRoutePrefix().'-disable', ['id' => $this->getId()]);
	}

	/**
	 * Получает url для активации сущности
     *
	 * @return string
	 */
	public function getActivateUrl(): string
	{
		return route($this->getRoutePrefix() . '-activate', ['id' => $this->getId()]);
	}

    /**
     * @return string
     */
	private function getRoutePrefix(): string
    {
        if (empty($this->routePrefix)) {
            $this->routePrefix = Str::kebab(Str::camel((new self())->getTable()));
        }
        return $this->routePrefix;
    }

	/**
	 * Получает url для удаления сущности
     *
	 * @return string
	 */
	public function getDeleteUrl(): string
	{
		return route($this->getRoutePrefix() . '-delete', ['id' => $this->getId()]);
	}

    /**
     * Получает url для массового удаления сущности
     *
     * @return string
     */
    public function getMassDeleteUrl(): string
    {
        return route($this->getRoutePrefix() . '-mass-delete');
    }

}
