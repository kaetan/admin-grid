<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission\Permission;
use App\Services\Admin\FieldServices\FieldServiceAbstract;
use App\Services\Admin\UpdateService\UpdateServiceAbstract;
use App\Models\ModelAbstract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

abstract class EditControllerAbstract extends ControllerAbstract
{
    /**
     * Объекты
     */
    protected ModelAbstract|null $row = null;

    /**
     * Простые поля
     */
    protected string $successEditMessage = 'Сохранено';
    protected string $successNewMessage = 'Создано';
    protected string $nameRow = 'элемента';
    protected string $editView = 'default.edit';

    abstract protected function getUpdateService(): UpdateServiceAbstract;
    abstract protected function getFieldService(): FieldServiceAbstract;

    /**
     * Делится списком роутов
     */
    protected function shareListRoute()
    {
        view()->share('mainRoute', $this->getModelAlias());
    }

    /**
     * Экшн редактирования
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function edit(): Factory|Redirector|View|RedirectResponse
    {
        $row = $this->_getEditRow();

        if (empty($row) && $this->createRows !== true) {
            return redirect()->back();
        }

        $this->_setEditTitle($row, $this->nameRow);

        $this->shareListRoute();

        if (request()->isMethod('post')) {
            $this->checkAccess(Permission::ACTION_WRITE);
            $updateService = $this->getUpdateService();

            try {
                DB::beginTransaction();

                $result = $updateService->update();

                if ($result) {
                    $message = $row ? $this->successEditMessage : $this->successNewMessage;
                    DB::commit();
                    session()->flash('message', ['type' => 'success', 'text' => $message]);
                    return redirect($result->getEditUrl());
                } else {
                    DB::rollBack();
                }
            } catch (ValidationException  $e) {
                DB::rollBack();
                Log::error($e->getTraceAsString());
                session()->flash('message', ['type' => 'error', 'text' => 'Не заполнены обязательные поля.']);
                return redirect(url()->previous())
                    ->withErrors($updateService->getValidator())
                    ->withInput();

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getTraceAsString());
                session()->flash('message', ['type' => 'error', 'text' => $e->getMessage()]);
                return redirect(url()->previous())
                    ->withErrors($updateService->getValidator())
                    ->withInput();
            }
        }

        view()->share('title', $this->title);

        return view($this->getEditView(), $this->getEditParams());
    }

    /**
     * Получает вьюшку для страницы редактирования
     * @return string
     */
    protected function getEditView(): string
    {
        return $this->editView ?? $this->getModelAlias() . '.edit';
    }

    /**
     * Получает параметры, передаваемые в шаблон страницы редактирования сущности
     */
    protected function getEditParams(): array
    {
        return [
            'backUrl' => $this->getModelAlias(),
            'row' => $this->_getEditRow(),
            'fields' => $this->_getEditFields(),
        ];
    }

    /**
     * Получает поля для редактирования
     * @return array
     */
    protected function _getEditFields(): array
    {
        $fieldGetter = $this->getFieldService();
        $fieldGetter->setRow($this->_getEditRow());

        return $fieldGetter->getFields();
    }

    /**
     * Возвращает сущность для редактирования
     * @return ModelAbstract|null
     */
    public function _getEditRow(): ?ModelAbstract
    {
        $model = $this->getModel();

        if (empty($this->row)) {
            $id = request('id');
            $this->row = $id ? $model::query()->find($id) : null;
        }

        return $this->row;
    }

    /**
     * Метод для определения заголовка страницы
     * Вынесено в отдельный метод, т.к. позволяет использовать инстанс модели, не делая доп. запроса.
     * @param $row
     * @param $nameRow
     */
    protected function _setEditTitle($row, $nameRow)
    {
        $this->title = ($row ? 'Редактирование ' . $nameRow . ' №' . $row->id : 'Добавление ' . $nameRow);
    }

    /**
     * @return string
     */
    public function getModelAlias(): string
    {
        $model = $this->getModel();

        return str_replace('_', '-', $model->getTable());
    }

}
