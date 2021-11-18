<div>
    @foreach($actions as $action)
        @if($action->hasModal())
            {!! $action->getModal($row) !!}
        @endif
    @endforeach
</div>