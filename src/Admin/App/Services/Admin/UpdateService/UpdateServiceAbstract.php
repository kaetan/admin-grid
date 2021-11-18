<?php

namespace App\Services\Admin\UpdateService;

use App\Services\Admin\UpdateService\Modules\Field\FieldModule;
use App\Services\Admin\UpdateService\Modules\UpdateModuleAbstract;
use App\Models\ModelAbstract;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

/**
 * Class AbstractUpdateService
 */
abstract class UpdateServiceAbstract implements UpdateServiceInterface
{
    public array $rules;
    public array $messages;
    public array $updateModules = [
        FieldModule::class,
    ];
    protected array $ignoreItemsBase = [];

    /**
     * AbstractUpdateService constructor.
     *
     * @param ModelAbstract $entity
     * @param array $requestData
     * @param string $modelClass
     */
    public function __construct(public ModelAbstract $entity, public array $requestData, public string $modelClass)
    {
    }

    /**
     * Задаем модули для обновления с помощью вызова $this->addModule()
     */
    public function setModules(): void
    {
    }

    /**
     * Запуск оновления всех сервисов
     *
     * @return ModelAbstract
     * @throws ValidationException
     */
    public function update(): ModelAbstract
    {
        if ($this->entity) {
            $creatingNewEntity = false;
        } else {
            $this->entity = new ($this->modelClass)();
            $creatingNewEntity = true;
        }

        $this->beforeUpdate($creatingNewEntity);
        $this->makeValidate();
        $this->validate();
        $this->setModules();

        foreach ($this->updateModules as $updateModuleClass) {
            /** @var UpdateModuleAbstract $updateModule */
            $updateModule = (new $updateModuleClass($this->entity, $this->requestData));

            if ($updateModuleClass == FieldModule::class) {
                $updateModule->addIgnoreItems($this->ignoreItemsBase);
            }

            $this->entity = $updateModule->update();
        }

        // Если создание/обновление выполнено успешно, запустим метод afterUpdate
        if ($this->entity) {
            $this->afterUpdate($creatingNewEntity);
        }

        return $this->entity;
    }

    /**
     * Валидация данных перед сохранением
     *
     * @return bool
     * @throws ValidationException
     */
    protected function validate(): bool
    {
        if (!empty($this->getRules())) {
            $validator = $this->getValidator();

            if ($validator->fails()) {
                $messages = $validator->messages();
                $message = 'Ошибка заполнения формы. Необходимо исправить следующие поля: ';
                $message .= implode(', ',$messages->keys());
                throw new ValidationException($validator, $message);
            }
        }

        return true;
    }

    public function getValidator()
    {
        if (empty($this->getRules())) {
            return null;
        }

        return Validator::make($this->requestData, $this->getRules(), $this->getMessages());
    }

    public function makeValidate()
    {
    }

    /**
     * Добавляем сервисы
     *
     * @param string $updateModule
     *
     * @return $this
     */
    public function addModule(string $updateModule): static
    {
        $this->updateModules[] = $updateModule;

        return $this;
    }

    /**
     * @param array $rules
     */
    public function addRules(array $rules)
    {
        $this->rules = array_merge($rules);
    }

    /**
     * @param array $messages
     */
    public function addMessages(array $messages)
    {
        $this->messages = array_merge($messages);
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return  $this->rules;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param bool $createdNewEntity
     */
    protected function beforeUpdate(bool $createdNewEntity): void
    {
    }

    /**
     * Метод, выполняющийся после успешного создания/обновления записи в БД.
     * Принимает флаг, указывающий, была ли создана новая запись.
     *
     * @param bool $createdNewEntity
     */
    protected function afterUpdate(bool $createdNewEntity): void
    {
    }

}
