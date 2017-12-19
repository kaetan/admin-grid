@if (!empty($actions))
    <td class="{{ $grid->getActionsClass() }}">
        <div class="btn-group clearfix pull-right">
            @foreach($actions as $action)
                @if ($action->getUrl($row) !== null)
                    <a href="{{ $action->getUrl($row) }}" class="{{ $action->getClass()?: 'btn-white'}} btn btn-xs">{{ $action->title }}</a>
                @endif
            @endforeach
        </div>
    </td>
@endif