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

                <div class="row" style="padding: 15px;">
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-sm">Добавить</button>
                    </div>
                    <div class="col-sm-7" style="text-align: center;">
                        <ul class="pagination" style="margin: 0"><li class="footable-page-arrow disabled"><a data-page="first" href="#first">«</a></li><li class="footable-page-arrow disabled"><a data-page="prev" href="#prev">‹</a></li><li class="footable-page active"><a data-page="0" href="#">1</a></li><li class="footable-page"><a data-page="1" href="#">2</a></li><li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li><li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li></ul>
                    </div>
                    <div class="col-sm-3">
                        <div class="pull-right">
                            20 из 284&nbsp;&nbsp;&nbsp;<label><!-- Показывать --><select name="size" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded" data-page-size="15">
                            <thead>
                            <tr>
                                @foreach ($columns as $i => $col)
                                    <th {{--data-toggle="true" data-hide="phone"--}} class="footable-visible {{ !$i ? 'footable-first-column' : ''}} {{ ((($i + 1) == count($columns)) && empty($actions)) ? 'footable-last-column' : ''}} {{ $col->sortable ? 'footable-sortable' : ''}}">{{ $col->title}}<span class="footable-sort-indicator"></span></th>
                                @endforeach

                                <th class="text-right footable-visible footable-last-column" data-sort-ignore="true">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rows as $i => $row)
                                <tr class="{{ (($i % 2) == 1) ? 'footable-even' : 'footable-odd'}}" style="">

                                    @foreach ($columns as $i => $col)
                                        <td {{--data-toggle="true" data-hide="phone"--}} class="footable-visible {{ !$i ? 'footable-first-column' : ''}} {{ ((($i + 1) == count($columns)) && empty($actions)) ? 'footable-last-column' : ''}}">{{ $col->getValue($row)}}</td>
                                    @endforeach
                                    <?/*
                                    <td class="footable-visible">
                                        <span class="label label-primary">Enable</span>
                                    </td>
                                    */?>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">View</button>
                                            <button class="btn-white btn btn-xs">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <?/*
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 1
                                </td>
                                <td class="footable-visible">
                                    Model 1
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $50.00
                                </td>
                                <td class="footable-visible">
                                    1000
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 2
                                </td>
                                <td class="footable-visible">
                                    Model 2
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $40.00
                                </td>
                                <td class="footable-visible">
                                    4300
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 3
                                </td>
                                <td class="footable-visible">
                                    Model 3
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $22.00
                                </td>
                                <td class="footable-visible">
                                    300
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-danger">Disabled</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 4
                                </td>
                                <td class="footable-visible">
                                    Model 4
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $67.00
                                </td>
                                <td class="footable-visible">
                                    2300
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 5
                                </td>
                                <td class="footable-visible">
                                    Model 5
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $76.00
                                </td>
                                <td class="footable-visible">
                                    800
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-warning">Low stock</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 6
                                </td>
                                <td class="footable-visible">
                                    Model 6
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $60.00
                                </td>
                                <td class="footable-visible">
                                    6000
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-danger">Disabled</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 7
                                </td>
                                <td class="footable-visible">
                                    Model 7
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $32.00
                                </td>
                                <td class="footable-visible">
                                    700
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-danger">Disabled</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 8
                                </td>
                                <td class="footable-visible">
                                    Model 8
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $86.00
                                </td>
                                <td class="footable-visible">
                                    5180
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 9
                                </td>
                                <td class="footable-visible">
                                    Model 9
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $97.00
                                </td>
                                <td class="footable-visible">
                                    450
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 10
                                </td>
                                <td class="footable-visible">
                                    Model 10
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $43.00
                                </td>
                                <td class="footable-visible">
                                    7600
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 1
                                </td>
                                <td class="footable-visible">
                                    Model 1
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $50.00
                                </td>
                                <td class="footable-visible">
                                    1000
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 2
                                </td>
                                <td class="footable-visible">
                                    Model 2
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $40.00
                                </td>
                                <td class="footable-visible">
                                    4300
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 3
                                </td>
                                <td class="footable-visible">
                                    Model 3
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $22.00
                                </td>
                                <td class="footable-visible">
                                    300
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-warning">Low stock</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 4
                                </td>
                                <td class="footable-visible">
                                    Model 4
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $67.00
                                </td>
                                <td class="footable-visible">
                                    2300
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 5
                                </td>
                                <td class="footable-visible">
                                    Model 5
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $76.00
                                </td>
                                <td class="footable-visible">
                                    800
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="display: none;">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 6
                                </td>
                                <td class="footable-visible">
                                    Model 6
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $60.00
                                </td>
                                <td class="footable-visible">
                                    6000
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="display: none;">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 7
                                </td>
                                <td class="footable-visible">
                                    Model 7
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $32.00
                                </td>
                                <td class="footable-visible">
                                    700
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="display: none;">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 8
                                </td>
                                <td class="footable-visible">
                                    Model 8
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $86.00
                                </td>
                                <td class="footable-visible">
                                    5180
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-even" style="display: none;">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 9
                                </td>
                                <td class="footable-visible">
                                    Model 9
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $97.00
                                </td>
                                <td class="footable-visible">
                                    450
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="footable-odd" style="display: none;">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    Example product 10
                                </td>
                                <td class="footable-visible">
                                    Model 10
                                </td>
                                <td style="display: none;">
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                                    that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </td>
                                <td class="footable-visible">
                                    $43.00
                                </td>
                                <td class="footable-visible">
                                    7600
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            */?>


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6" class="footable-visible">
                                    <ul class="pagination pull-right"><li class="footable-page-arrow disabled"><a data-page="first" href="#first">«</a></li><li class="footable-page-arrow disabled"><a data-page="prev" href="#prev">‹</a></li><li class="footable-page active"><a data-page="0" href="#">1</a></li><li class="footable-page"><a data-page="1" href="#">2</a></li><li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li><li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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