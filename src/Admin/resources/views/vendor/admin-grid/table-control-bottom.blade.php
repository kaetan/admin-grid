<div class="row" style="padding: 15px 0;">
    <div class="col-sm-2">
        @if ($actionButtonVisibility)
            <div class="input-group-btn js-dropdown-menu-container">
                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle js-mass-update">Действия <span
                            class="caret"></span></button>
                <ul class="dropdown-menu js-dropdown-menu">
                    @foreach($massActions as $action)
                        <li>
                            <form method="post" class="js-mass-update-form" action="{{ $action->getUrl(null) }}">
                                {{ csrf_field() }}
                                @php
                                    $btnClass = ($action->getClass() ?? '')
                                        . ($action->needConfirm() ? 'js-need-confirm' : '');
                                    $confirmMessage = $action->getConfirmMessage();
                                @endphp
                                <button class="btn btn-link js-mass-update-btn {{ $btnClass }}"
                                        @if($action->hasModal()) data-toggle="modal"
                                        @if(!empty($confirmMessage)) data-confirm-message="{{ $confirmMessage }}" @endif
                                        href="{{$action->getUrl(null)}}" @endif>
                                    {{ $action->getTitle() }}
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if (!empty($massActions))
                @include('vendor.admin-grid.modals', ['actions' => $massActions, 'row' => null])
            @endif
        @endif
    </div>
    <div class="col-sm-6" style="text-align: center;">
        @include('admin-grid::pagination', ['pagesUrl' => $pagesUrl ?? null])
    </div>
    <div class="col-sm-4">
        @include('admin-grid::sizes')
    </div>
</div>