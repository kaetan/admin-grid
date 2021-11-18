@if(!empty($showControlStatic))
    @php($groupProxy = 'proxy-group')
@else
    @php($groupProxy = '')
@endif
@if(empty($transactionIntervals))
<div class="form-group form-group--middle {{$groupProxy}}">
    @if(!empty($title))
        {{ Form::label($name , $title, ['class' => 'col-sm-' . $titleWidth . ' control-label control-label--no-padding']) }}
    @endif
    <div class="col-sm-{{ $fieldWidth }}">
        @if(empty($showControlStatic))
            <p class="form-control-static">
                @endif
                <span class="{{ !empty($buttonClass) && $value != '&mdash;' ? 'txt' : '' }}">
                    {!! $value  !!}
                </span>
                @if(!empty($buttonClass) && $value != '&mdash;')
                    <span class="btn {!! $buttonClass  !!} fa fa-eye"></span>
                @endif
                @if(empty($showControlStatic))
            </p>
        @endif
    </div>
</div>
@else
    <div class="form-group form-group--middle {{$groupProxy}}">
    @if(!empty($title))
        {{ Form::label($name , $title, ['class' => 'col-sm-' . $titleWidth . ' control-label control-label--no-padding']) }}
    @endif
        <div class="col-sm-{{ $fieldWidth }}">
                @include('_partials.form.min-max-value',[
                'name' => $name,
                'value' => $transactionIntervals,
                'fieldWidth' => $fieldWidth,
                ])
        </div>
    </div>
@endif