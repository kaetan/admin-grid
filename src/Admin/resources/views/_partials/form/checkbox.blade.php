<div class="i-checks">
    <label class="js-checkbox-group">
        <input type='hidden' value='{{ !empty($value) ? '1' : (!empty($valueStatic) ? '1' : '0') }}'
               name='{{ $name }}' id='{{ $name }}' class="js-checkbox-hidden {{ !empty($classHidden) ? $classHidden : '' }}" {!! $attr ?? '' !!}
        />
        <input type="checkbox" {{ !empty($value) ? 'checked' : (!empty($valueStatic) ? 'checked' : '') }}
                id='{{ $name }}'
               class="js-has-hidden {{ !empty($class) ? $class : '' }} js-checkbox-hidden-content"
               @if(!empty($dataAtr)) data-linked-container="{{ $dataAtr }}" @endif
        /><i></i>&nbsp;
    </label>
    {!! $subTitle ?? '' !!}
</div>
@include('_partials.edit.error', ['name' => $name])
