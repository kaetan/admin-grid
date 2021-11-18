@extends('layouts.app')

@section('title', $title ?? 'Page')

@if ($grid->getShowFilter())
@section('filter')
    <div class="row">
        <div class="col-lg-12">
            @include('_partials.filter.filter')
        </div>
    </div>
@endsection
@endif

@section('content')
    @yield('filter')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>{{ $title ?? 'Page' }}</h5>
                        </div>
                        @if (isset($addUrl))
                            <div class="col-md-1 col-md-offset-8">
                                <a href="{{ $addUrl }}" class="btn btn-primary btn-sm pull-right">Добавить</a>
                            </div>
                        @endif
                    </div>
                </div>
                @include('grid.gridView', [
                    'gridContainerClass' => $gridContainerClass ?? '',
                    'gridContainerAttributes' => $gridContainerAttributes ?? '',
                    'grid' => $grid,
                ])
            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="message-modal" tabindex="-1" role="dialog" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                </div>
                <div class="modal-body js-modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endsection
