@if (!empty($actions))
    <td class="{{ $actionClass ?? '' }}">
        <div class="btn-group action-loader__container {{ $cssClass ?? 'clearfix pull-right' }} js-dropdown-menu-container">
            @php
                    $act = $actionItem ?? 'Действие ';
                    $statusLoader =  null;
            @endphp


            @if (!empty($actionClass) && !empty($statusLoader) && strpos($actionClass, 'action-loader') !== false)
                <div class="status-loader">
                <div class="action-loader__loader"
                     title="{{ $statusLoader->getMessage() }}">
                    @if ($statusLoader->getStatusType() == 'circle')
                        @include('_partials.loaders.fading-circle', ['class' => 'action-loader__loader-circle'])
                    @else
                        <i style="font-size: 15px;" class="fa fa-hourglass-half" aria-hidden="true"></i>
                    @endif
                </div>
                </div>
            @endif

            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">{!! $act !!}<span class="caret"></span></button>
            <ul class="dropdown-menu js-dropdown-menu">
                @foreach($actions as $action)
                    @if ($action->getUrl($row) !== null)
                        <li>
                            <a {!! $action->getAttributes() !!}
                               href="{{ $action->getUrl($row)}}"
                               class="{{$action->getClass()}}"
                               @if($action->hasModal())
                               data-toggle="modal" @endif>{{ $action->title }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        {{-- Модалки некорректно работают внутри тега <ul> --}}
        @include('vendor.admin-grid.modals', ['actions' => $actions, 'row' => $row])
    </td>
@endif