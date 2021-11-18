@php
    $fieldView = !empty($fieldView) ? $fieldView : '_partials.form.' . ($type == \App\Entity\Form\Field::TYPE_NUMBER ? 'text' : $type);
    $labelClass = !empty($labelClass) ? $labelClass : '';
@endphp
<div class="form-group {{ $classFormGroup??'' }} {{ !empty($undertext) ? '' : 'form-group--middle' }}
@if(!empty($errors))
{{  $errors->has(arrNotationToDotNotation($name)) ? 'has-error' : '' }}
@endif{{ $formClass ?? '' }}" {{ $attributes ?? '' }}>
    @if(!empty($title))
        {!! html_entity_decode(Form::label($name, $title, ['class' => 'col-sm-' . $titleWidth . ' control-label ' . (!empty($undertext) ? '' : 'control-label--no-padding' ) . ' ' . $labelClass])) !!}
    @endif
    <div class="col-sm-{{ $fieldWidth }}">
        @include($fieldView, ['viewValues' => $viewValues ?? []])
        @if(!empty($subView))
            {!! $subView !!}
        @endif
    </div>
</div>
