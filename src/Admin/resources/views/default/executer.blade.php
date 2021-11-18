@extends('layouts.app-edit')
@section('title', $title ?? 'Page')

@section('content-container')
    @if(!empty(session('message')))
        <div class="js-toastr-message hidden"
             data-toastr="{{ session('message')['type'] }}">{{ session('message')['text'] }}</div>
    @endif

    {{ Form::open(['url' => $saveUrl ?? assemble_url(), 'method' => 'post', 'class' => 'js-edit-form edit-form form-horizontal']) }}
    <div class="form-horizontal col-md-8">
        @include('_partials.form.fields', ['fields' => $fields])
        <div class="col-sm-4"></div>
            <button class="btn btn-primary">Выполнить</button>
    </div>
    {{ Form::close() }}
    <div class="col-md-4">
        <h3 style="margin-left: 12px;">Доступные кошельки</h3>
        <div class="row">
            @if(isset($wallets))
                @foreach($wallets as $wallet)
                    <ul>
                        <li>
                            <a href="{!!  $wallet->getUrl() !!}">{!! $wallet->number . ' ' !!}</a>
                            {!! format_money($wallet->balance) . ' RUR' !!}
                        </li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>

    @yield('filter')
    <div class="row">
        <div class="col-lg-12" style="padding-top: 20px;">
            <div class="ibox">
                <div class="ibox-content js-grid-container">
                    {!! $grid->render() !!}
                </div>
            </div>
        </div>
    </div>

@endsection