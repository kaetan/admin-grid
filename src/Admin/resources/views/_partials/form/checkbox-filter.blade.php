<div class="i-checks">
    <div class="filter-padding">
    <label class="js-checkbox-group">
        <input type='hidden' value='{{ !empty($value) ? '1' : '0' }}'
               name='{{ $name }}' class="js-checkbox-hidden" {!! $attr ?? '' !!}
        />
        <input type="checkbox"
               {{ !empty($value) ? 'checked' : '' }}
               class="js-has-hidden {{ !empty($class) ? $class : '' }} js-checkbox-hidden-content"
               @if(!empty($dataAtr)) data-linked-container="{{ $dataAtr }}" @endif
        /><i></i>&nbsp;&nbsp;&nbsp;{!! $subTitle ?? '' !!}
    </label>
    </div>
</div>
@include('_partials.edit.error', ['name' => $name])