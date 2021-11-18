@php
    $name = !empty($name) ? $name : null;
    $selectOptions = array();

    if (!empty($name)) {
        $name = $name.(!empty($multiple) ? '[]' : '');
    }
    $selectOptions['class'] ='form-control '. (!empty($class) ? $class : '');

    if (!empty($multiple)) {
        $selectOptions['multiple'] = 'multiple';
    }

    if (!empty($placeholder)) {
        $selectOptions['data-placeholder'] = $placeholder;
    }

    if (!empty($placeholder)) {
        $selectOptions['placeholder'] = $placeholder;
    }

    if (empty($canEmpty)) {
        unset($selectOptions['placeholder']);
    }

    if(!empty($disabled)) {
        $selectOptions['disabled'] = true;
    }
    $selectedValue = null;
    if (isset($values)) {
        $selectedValue = $values;
    } else if (isset($value)){
        $selectedValue = $value;
    }

    $optionsAttributes = [];
    foreach($options ?? [] as $val => $title) {
        if (isset($value) && $val == $value) {
            $optionsAttributes[$val] = ['class' => 'js-default'];
        }

        if (isset($values) && in_array($val, $values)) {
             $optionsAttributes[$val] = ['class' => 'js-default'];
        }
    }

    if (!empty($inputAttributes)) {
        foreach ($inputAttributes as $attribute) {
            $selectOptions[$attribute['name']] = $attribute['value'];
        }
    }

@endphp

{{ Form::select($name, $options, $selectedValue, $selectOptions, $optionsAttributes) }}
@if (!empty($undertext))
    <span class="form-text m-b-none">{!! $undertext !!}</span>
@endif
@if(empty($hideError))
    @include('_partials.edit.error', ['nameError' => $nameError ?? $name])
@endif
