<textarea
        rows="{{ !empty($textareaRows) ? $textareaRows : 10 }}"
        name="{{ $name }}{{ !empty($multiple) ? '[]' : '' }}"
        class="form-control js-input-placeholder-container {{ !empty($class)?$class:null }}"
        placeholder="{{ !empty($placeholder) ? $placeholder : '' }}"
        {{ !empty($disabled) ? 'disabled="disabled"' : '' }}
>{!! !empty($value) ? $value : '' !!}
</textarea>
@include('_partials.edit.error', ['name' => $name])
