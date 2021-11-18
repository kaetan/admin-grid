<?php

namespace App\Services\Admin\FieldServices\User;

use App\Entity\Form\Field;
use App\Entity\Form\OutputField;
use App\Models\User;
use App\Services\Admin\FieldServices\FieldServiceAbstract;

class UserFieldService extends FieldServiceAbstract
{
    public function getFields(): array
    {
        /** @var User $row */
        $row = $this->row;

        return [
            (new OutputField('id', $this->row, [
                'title' => 'ID',
                'type' => OutputField::TYPE_TEXT,
                'value' => $row->getId(),
            ])),
            (new OutputField('role', $this->row, [
                'title' => 'Роль',
                'type' => OutputField::TYPE_TEXT,
                'value' => $row->getRoleName(),
            ])),
            (new Field('phone', Field::TYPE_TEXT, [
                'title' => 'Телефон',
                'value' => $row->getPhone(),
            ])),
            (new Field('email', Field::TYPE_TEXT, [
                'title' => 'Email',
                'value' => $row->getEmail(),
            ])),
            (new Field('last_name', Field::TYPE_TEXT, [
                'title' => 'Фамилия',
                'value' => $row->getLastName(),
            ])),
            (new Field('first_name', Field::TYPE_TEXT, [
                'title' => 'Имя',
                'value' => $row->getFirstName(),
            ])),
        ];
    }
}
