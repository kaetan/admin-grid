<div>
@if($value)
        <div class="col-sm-1" style="{{isset($showCheckbox) && $showCheckbox ? 'margin-top: 95px' : 'padding-top: 40px'}}">
            {{--<button class="btn btn-success  dim" type="button" disabled>--}}
            {{--<i class="fa fa-upload"></i>--}}
            {{--</button>--}}
            <a class="vertical-timeline-icon blue-bg" href="{{$value}}"  download title="Скачать документ">
                <i class="fa fa-file-text"></i>
            </a>
        </div>
@else
        <div class="col-sm-1" style="{{isset($showCheckbox) && $showCheckbox ? 'margin-top: 95px' : 'padding-top: 40px'}}">
            <a class="vertical-timeline-icon gray-bg"  title="Документ не загружен">
                <i class="fa fa-file-text"></i>
            </a>
        </div>
@endif

    @if(isset($showCheckbox) && $showCheckbox)
        <div class="i-checks col-sm-1" style="{{isset($showCheckbox) && $showCheckbox ? 'padding-top: 105px' : 'padding-top: 10px'}}; padding-left: 30px">
            <label class="js-checkbox-group">
                <input type='hidden' value='{{ !empty($checked) ? '1' : '0' }}'
                       name='{{ $name }}' class="js-checkbox-hidden {{ !empty($classHidden) ? $classHidden : '' }}" {!! $attr ?? '' !!}
                />
                <input type="checkbox" name='{{'checkbox-' . $name }}'
                       {{ !empty($checked) ? 'checked' : '' }}
                       class="js-has-hidden {{ !empty($class) ? $class : '' }} js-checkbox-hidden-content"
                />
            </label>
            {!! $subTitle ?? '' !!}
        </div>
        <div class="col-sm-8">

            <div style="margin-bottom: 5px;"><b>{!! $textTitle ?? '' !!}</b></div>

            <textarea
                rows="{{ !empty($textareaRows) ? $textareaRows : 10 }}"
                name="{{ $nameText ?? 'area' }}{{ !empty($multiple) ? '[]' : '' }}"
                class="form-control js-input-placeholder-container {{ !empty($class)?$class:null }}"
                placeholder="{{ !empty($placeholder) ? $placeholder : '' }}"
        {{ !empty($disabled) ? 'disabled="disabled"' : '' }}>{!! !empty($valueText) ? $valueText : '' !!}</textarea>
        </div>
    @endif
</div>
