@extends('layouts.app-edit')

@section('title', $title ?? 'Page')

@section('content-container')

    <div class="sk-spinner sk-spinner-double-bounce">
        <div class="sk-double-bounce1"></div>
        <div class="sk-double-bounce2"></div>
    </div>
    @if(!empty(session('token-message')))
        <div class="js-token-message hidden" data-toastr="info">{{ session('token-message')['text'] }}</div>
    @endif
    @if(!empty(session('message')))
        <div class="js-toastr-message hidden"
             data-toastr="{{ session('message')['type'] }}">{{ session('message')['text'] }}</div>
    @endif

    {{ Form::open(['url' => $saveUrl ?? assemble_url(), 'method' => 'post', 'class' => 'js-edit-form edit-form form-horizontal']) }}

    <button class="btn btn-primary js-save-btn">Сохранить</button>

    @include('_partials.form.fields', ['fields' => $fields])

    <button class="btn btn-primary js-save-btn">Сохранить</button>


    {{ Form::close() }}
@endsection
