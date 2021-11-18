<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Auth extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'phone' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'phone.required' => 'Телефон обязателен',
            'password.required' => 'Пароль обязателен',
        ];
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->input('phone');
    }

    /**
     * @return mixed|string|null
     */
    public function getPassword()
    {
        return $this->input('password');
    }
}
