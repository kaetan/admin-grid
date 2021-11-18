
    @if ($showSelectColumn)
        <td><input type="checkbox" class="i-checks js-check-item" name="input[{{ $row->id }}]" data-id="{{ $row->id }}"></td>
    @endif

    @foreach ($columns as $k => $col)
        @php
            $value = trim($col->getValue($row));
            if (!$value && !empty($showDashOnEmpty)) {
                $value = '&mdash;';
            }
        @endphp
        <td class="{{ $col->getClass() }}" style="{{ $col->getStyle() }}">
            {!! $value !!}</td>
    @endforeach

    @include('admin-grid::actions', [
        'actions' => !empty($actions)?$actions:[],
        'actionClass' => $actionClass ?? null,
        'actionItem' => '<i class="fa fa-cog"></i> ',
        'row' => $row,
    ])
