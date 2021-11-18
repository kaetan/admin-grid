@php

    $textOptions = [];
    if(!empty($type) && ($type == 'password' || $type == 'number')) {
        $textHelper = $type;
    } else if(!empty($typeOverride)) {
        $textHelper = $typeOverride;
    } else {
        $textHelper = 'text';
    }

    $textOptions['placeholder'] = $placeholder ?? '';
    $textOptions['class'] = 'form-control '.($class ?? '');

    if (!empty($disabled)) {
        $textOptions['disabled'] = 'disabled';
    }

    if (!empty($readonly)) {
        $textOptions['readonly'] = 'readonly';
    }

    if (!empty($autofocus)) {
        $textOptions['autofocus'] = 'readonly';
    }

    if (!empty($required)) {
        $textOptions['required'] = 'required';
    }

    if (!empty($autocomplete)) {
        $textOptions['autocomplete'] = 'off';
    }

    if (!empty($attributes) && is_array($attributes)) {
        foreach ($attributes as $name => $attribute) {
            $textOptions[$name] = $attribute;
        }
    }

    if (!empty($fieldType)) {
        $textHelper = $fieldType;
    }


@endphp
@if ($textHelper == 'password' || $textHelper == 'file')
    {{ Form::$textHelper(($name . (!empty($multiple) ? '[]' : '')), $textOptions) }}
@else
    {{ Form::$textHelper(($name . (!empty($multiple) ? '[]' : '')), ($value ?? ($valueStatic ?? null)), $textOptions) }}
@endif
@if (!empty($undertext))
    <span class="form-text m-b-none">{!! $undertext !!}</span>
@endif

@if (empty($noError))
    @include('_partials.edit.error', ['name' => $name])
@endif
