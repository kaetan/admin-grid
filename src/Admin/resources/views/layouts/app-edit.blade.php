@extends('layouts.app')

@section('title', $title ?? 'Page')

@section('content')

    @include('_partials.edit.controls', [
        'backUrl' => !empty($mainRoute) ? route($mainRoute) : null,
    ])
    <div class="ibox js-ibox-on-page">
        <div class="ibox-title">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $title ?? 'Page' }}</h2>
                </div>
            </div>
        </div>
        <div class="ibox-content js-ibox-content js-grid-container">
            @yield('content-container')
        </div>
    </div>
@endsection
