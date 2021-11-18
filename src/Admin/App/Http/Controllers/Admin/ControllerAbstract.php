<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Rbac\Resource;
use App\Extensions\Grid\Entity\Button;
use App\Extensions\Grid\Grid;
use App\Models\Permission\Permission;
use App\Models\User;
use App\Services\Admin\Grid\ActionMakers\ActionMakerInterface;
use App\Services\Admin\Grid\ActionMakers\ActionMakerParams;
use App\Services\Admin\Grid\ColumnMakers\ColumnMakerInterface;
use App\Services\Admin\Grid\FilterMakers\FilterFunctions\FilterFunctionsInterface;
use App\Services\Admin\Grid\FilterMakers\Filters\FiltersInterface;
use App\Services\Admin\Grid\GridService;
use App\Models\ModelAbstract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

abstract class ControllerAbstract extends Controller
{
    /**
     * Объекты
     */
    protected ModelAbstract $model;
    protected Grid $grid;
    protected User $user;

    /**
     * Простые поля
     */
    protected bool $createRows = true;
    protected bool $showFilter = true;
    protected bool $actionButtonVisibility = true;
    protected array $fields = [];
    protected string $title = '';
    protected string $titleEdit = '';
    protected string $indexView = 'default.index';
    protected string $permissionResource = Resource::ADMIN_PANEL;

    public function __construct()
    {
        defined('IS_ADMIN') || define('IS_ADMIN', true);

        $this->model = $this->getModel();
        $this->make();
    }

    abstract public function getModel(): ModelAbstract;
    abstract public function getColumnMaker(): ColumnMakerInterface;
    abstract public function getActionMaker(): ActionMakerInterface;
    abstract public function getFilterMaker(): ?FiltersInterface;
    abstract public function getFilterFunctionsMaker(): ?FilterFunctionsInterface;

    /**
     * производит кастомные действия в конструкторе
     */
    protected function make()
    {
    }

    /**
     * @param string $permissionResource
     * @param string $permission
     */
    protected function checkAccess(string $permissionResource = '', string $permission = '')
    {
        $permissionResource = $permissionResource ?? $this->permissionResource;
        $permission = $permission ?? Permission::ACTION_READ;
        $user = $this->getUser();

        if (!can($permissionResource, $permission, $user)) {
            abort(403, 'У вас нет доступа к данному действию!');
        }
    }

    /**
     * Экшн страницы списка
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request): Factory|View
    {
        $this->checkAccess();

        view()->share('title', $this->title);

        return view($this->indexView, $this->getIndexViewParams());
    }

    /**
     * Получает параметры для страницы списка
     * @return array
     */
    protected function getIndexViewParams(): array
    {
        $grid = $this->generateGrid($this->model);

        if ($this->createRows) {
            $grid->addIndexButton(new Button('Добавить', Button::TYPE_PRIMARY, $this->model->getEditUrl()));
        }

        $this->setIndexButtons();

        return [
            'grid' => $grid,
            'filters' => $this->getFilters(),
        ];
    }

    /**
     * Установка дополнительных кнопок на странице списка
     */
    public function setIndexButtons()
    {
    }

    /**
     * Собирает грид
     *
     * @param ModelAbstract $model
     * @return Grid
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function generateGrid(ModelAbstract $model): Grid
    {
        $this->grid = GridService::makeGrid($model, $this->showFilter, $this->getColumnMaker());

        $gridService = new GridService($this->grid, $this->getActionMaker());
        $gridService->setEditActions();

        // Фильтрация
        $this->grid->setFilterFunction($this->getFilterFunction());
        $this->grid->setActionButtonVisibility($this->actionButtonVisibility);

        return $this->grid;
    }

    /**
     * Для других наборов экшен-параметров можно переопределить этот метод в другом контроллере
     * @return ActionMakerParams
     */
    protected function getActionMakerParams(): ActionMakerParams
    {
        return new ActionMakerParams();
    }

    /**
     * Получает функцию для фильтрации грида
     * @return \Closure
     */
    protected function getFilterFunction(): \Closure
    {
        $filterFunctionsMaker = $this->getFilterFunctionsMaker();

        return $filterFunctionsMaker ? $filterFunctionsMaker->getFunctions() : function ($query, $params, $grid) {
            return $query;
        };
    }

    /**
     * Получение фильтров на странице списка
     * @return array
     */
    protected function getFilters(): array
    {
        $filterMaker = $this->getFilterMaker();

        return $filterMaker?->getFilter() ?? [];
    }

    /**
     * @return User
     */
    protected function getUser(): User
    {
        if (empty($this->user)) {
            $this->user = Auth::user();
        }

        return $this->user;
    }

    /**
     * Удаляет итем
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete()
    {
        $this->checkAccess(permission: Permission::ACTION_WRITE);

        $row = $this->model::query()->find(request('id'));

        if ($row) {
            $row->delete();
        } else {
            throw new \Exception('Попытка удалить несуществующий элемент');
        }

        return redirect()->back();
    }

    /**
     * Массовое удаление
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function massDelete()
    {
        $this->checkAccess(permission: Permission::ACTION_WRITE);

        $ids = request('ids');
        $this->model::query()->whereIn('id', $ids)->delete();

        return redirect()->back();
    }
}
