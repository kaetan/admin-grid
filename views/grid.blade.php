<div class="tabs-container">
    @if (!empty($tabs))
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1">Все</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">Оператор 1</a></li>
            <li class=""><a data-toggle="tab" href="#tab-3">Оператор 2</a></li>
            <li class=""><a data-toggle="tab" href="#tab-4">Изменено сегодня</a></li>
            <li class=""><a data-toggle="tab" href="#tab-5">Авто выплата</a></li>
        </ul>
    @endif
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <div class="panel-body">

                @include('admin-grid::table-control-top', [
                    'paginator' => $paginator,
                    'paginationOffset' => $paginationOffset,
                ])

                <div class="row">
                    <div class="col-lg-12">
                        <table class="js-footable table toggle-arrow-small" data-sorting="false">
                            <thead>
                            <tr>
                                <th data-sort-ignore="true"></th>

                                @foreach ($columns as $k => $col)
                                    <th {{--data-toggle="true" --}} data-sort-ignore="true" @if ($col->hide) data-hide="{{ $col->hide }}" @endif>{{ $col->title}}</th>
                                @endforeach

                                @if (!empty($actions))
                                    <th class="text-right" data-sort-ignore="true">Действия</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($rows as $i => $row)
                                <tr class="{{ $i % 2 == 1 ? 'footable-even' : 'footable-odd' }}">

                                    <td><input type="checkbox" class="i-checks" name="input[]"></td>

                                    @foreach ($columns as $k => $col)
                                        <td>{!! $col->getValue($row) !!}</td>
                                    @endforeach

                                    @if (!empty($actions))
                                        <td>
                                            <div class="btn-group">
                                                @foreach($actions as $action)
                                                    <a href="{{ $action->getUrl($row) }}" class="btn-white btn btn-xs">{{ $action->title }}</a>
                                                @endforeach
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                {!! $grid->getSubRowContent($row, $i) !!}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @include('admin-grid::table-control-bottom', [
                    'paginator' => $paginator,
                    'paginationOffset' => $paginationOffset,
                ])
            </div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="panel-body">

            </div>
        </div>
        <div id="tab-3" class="tab-pane">
            <div class="panel-body">

            </div>
        </div>
        <div id="tab-4" class="tab-pane">
            <div class="panel-body">

            </div>
        </div>
        <div id="tab-5" class="tab-pane">
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>