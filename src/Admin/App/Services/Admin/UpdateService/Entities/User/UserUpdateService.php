<?php

namespace App\Services\Admin\UpdateService\Entities\User;

use App\Services\Admin\UpdateService\UpdateServiceAbstract;

class UserUpdateService extends UpdateServiceAbstract
{
    public function makeValidate()
    {
        $rules = [
            'email' => 'required',
            'phone' => 'required',
        ];

        $this->addRules($rules);

        $this->addMessages([
            'email.required' => 'Email обязателен',
            'phone.required' => 'Номер телефона обязателен',
        ]);
    }
}
