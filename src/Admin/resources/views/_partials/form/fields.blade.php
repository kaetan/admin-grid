@php
    if(!empty($tab)) {
        $tabIndex = 1;
    }
    $params = [];
    $paramKeys = ['titleWidth', 'fieldWidth'];
    foreach ($paramKeys as $key) {
        if(!empty(${$key})) {
            $params[$key] = ${$key};
        }
    }
@endphp
@foreach($fields as $field)
    @if(!empty($tab))
    <div id="tab-{{ $field->getOption('tabIndex') ?? $tabIndex++ }}" class="tab-pane {{ $loop->first ? 'active' : '' }}" role="tabpanel">
    @endif
        @if($field->isHtml())
        {!! $field->getFields() !!}
        @else
        {!! $field->render($params) !!}
        @endif
    @if(!empty($tab))
    </div>
    @endif
@endforeach