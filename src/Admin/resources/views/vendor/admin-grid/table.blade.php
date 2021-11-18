<table class="js-footable js-select-all-container {{ $tableClass }} footable table toggle-arrow-small" data-sorting="false" style="width: 100%; @if (!empty($fixed))table-layout: fixed; @endif">
    <thead>
    <tr>
        @if ($showSelectColumn)
            <th data-sort-ignore="true" style="width: 35px;"><input type="checkbox" class="i-checks" id="js-select-all"></th>
        @endif

        @foreach ($columns as $k => $col)
            <th {{--data-toggle="true" --}}
                data-sort-ignore="true"
                @if ($col->hide) data-hide="{{ $col->hide }}" @endif
                class="
                    {{ $col->getClass() }}
                    @if ($sortable && $col->isSortable()) footable-sortable @endif
                    @if ($col->code == $sort->field)
                        footable-sorted{{$sort->direction != 'desc' ? '-desc' : ''}}
                    @endif"
                style="{{ $col->getStyle() }}"
            >
                @if ($sortable && $col->isSortable())
                    <a href="{{ assemble_url(null, ['sort' => $col->getSort($col->code == $sort->field ? $sort->direction : null)]) }}">
                        @endif
                        {{ $col->title}}

                        @if ($sortable && $col->isSortable())
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

    @if (count($rows))
        @foreach ($rows as $i => $row)
            @php($actionClass = $grid->getActionsClass())
            <tr data-id="{{ $row->id }}" {{ $grid->getRowAttributes($row) }}
            class="js-table-row {{ $i % 2 == 1 ? 'footable-even' : 'footable-odd' }}
                    {{ $rowClass }}">
                @include('vendor.admin-grid.table-row', ['row' => $row, 'actionClass' => $actionClass, 'actionItem' => '<i class="fa fa-cog"></i> '])
            </tr>
            {!! $grid->getSubRowContent($row, $i) !!}
        @endforeach
    @else
        @php($colCount = count($columns) + !empty($actions) + $showSelectColumn)
        <tr>
            <td colspan="{{ $colCount }}" class="text-center">Нет записей</td>
        </tr>
    @endif
    </tbody>
</table>