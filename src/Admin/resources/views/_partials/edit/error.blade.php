@php

    $name = $nameError ?? ($name ?? '');

@endphp

@if (!empty($errors) && !empty($name) && $errors->has(arrNotationToDotNotation($name)))
    <span class="help-block">
        <strong>{{ $errors->first(arrNotationToDotNotation($name)) }}</strong>
    </span>
@endif