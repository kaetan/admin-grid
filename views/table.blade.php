<table class="js-footable footable table toggle-arrow-small" data-sorting="false">
    <thead>
    <tr>
        <th data-sort-ignore="true"></th>

        @foreach ($columns as $k => $col)
            <th {{--data-toggle="true" --}}
                data-sort-ignore="true"
                @if ($col->hide) data-hide="{{ $col->hide }}" @endif
                class="
                    {{ $col->getClass() }}
                    @if ($col->isSortable()) footable-sortable @endif
                    @if ($col->code == $sort->field)
                        footable-sorted{{$sort->direction != 'desc' ? '-desc' : ''}}
                    @endif"
            >
                @if ($col->isSortable())
                    <a href="{{ assemble_url(null, ['sort' => $col->getSort($col->code == $sort->field ? $sort->direction : null)]) }}">
                        @endif
                        {{ $col->title}}

                        @if ($col->isSortable())
                    </a>
                    @if ($col->code == $sort->field)
                        <span class="footable-sort-indicator"></span>
                    @endif
                @endif
            </th>
        @endforeach

        @if (!empty($actions))
            <th class="text-right" data-sort-ignore="true">Действия</th>
        @endif
    </tr>
    </thead>

    <tbody>
    @foreach ($rows as $i => $row)
        <tr class="{{ $i % 2 == 1 ? 'footable-even' : 'footable-odd' }}">

            <td class="{{ $col->getClass() }}"><input type="checkbox" class="i-checks" name="input[]"></td>

            @foreach ($columns as $k => $col)
                <td>{!! $col->getValue($row) !!}</td>
            @endforeach

            @if (!empty($actions))
                <td>
                    <div class="btn-group">
                        @foreach($actions as $action)
                            @if ($action->getUrl($row) !== null)
                                <a href="{{ $action->getUrl($row) }}" class="btn-{{ $action->getBtnClass()?: 'white'}} btn btn-xs">{{ $action->title }}</a>
                            @endif
                        @endforeach
                    </div>
                </td>
            @endif
        </tr>
        {!! $grid->getSubRowContent($row, $i) !!}
    @endforeach
    </tbody>
</table>