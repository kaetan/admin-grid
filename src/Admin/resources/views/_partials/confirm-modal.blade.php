@php
    $modalId = $modalId ?? 'modal';
@endphp
<div id="{{  $modalId }}"
     class="js-modal modal fade @yield('modal-class', $modalClass ?? '')" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if(!empty($modalTitle))
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 class="modal-title">{{ $modalTitle }}</h3>
                </div>
            @endif
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="modal-text">
                            {{ $modalText ?? '' }}
                        </p>
                        <button class="btn btn-sm btn-primary pull-right {{ $btnClass ?? '' }}" data-style="zoom-out"
                                {!! $btnAttributes ?? '' !!}
                                @if(empty($notDismis)) data-dismiss="modal" @endif>
                            <strong>{{ $submitLabel ?? 'Отправить' }}</strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
