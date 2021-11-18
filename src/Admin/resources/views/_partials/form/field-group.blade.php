@if(empty($noBorders))
    <div class="field-group-split"></div>
@endif
<div class="field-group {{ $class . (!empty($tab) || (!empty($tabTitle)) ? ' m-t' : '') }}" {{ $attributes ?? '' }}>
    @isset($title)
        <div class="form-group">
            <div class="col-sm-{{ VIEW_TITLE_WIDTH }}">
            </div>
            <div class="col-sm-{{ VIEW_FIELD_WIDTH }}">
                <h3>
                    @if(!empty($titleUrl))
                        <a class="text-primary link-underline" href="{{ $titleUrl }}">{{ $title }}</a>
                    @else
                        {{ $title }}
                    @endif
                </h3>
            </div>
        </div>
    @endisset
    @if(!empty($tab))
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                @php($tabIndex = 1)
                @foreach($fields as $field)
                    <li @if (!empty($field->getOption('activeTab'))) class="active" @endif>
                        <a class="nav-link"
                           data-toggle="tab"
                           href="#tab-{{ $field->getOption('tabIndex') ?? $tabIndex++ }}"> {{ $field->getOption('tabTitle') }}</a>
                    </li>
                @endforeach
            </ul>
            @endif
            @if(!empty($tab))
                <div class="tab-content">
                    @endif
                    @include('_partials.form.fields', [
                        'fields' => $fields,
                    ])
                    @if(!empty($tab))
                </div>
        </div>
    @endif
</div>
@if(empty($noBorders))
    <div class="field-group-split"></div>
@endif
