@extends('layouts.app-edit')

@section('title', $title ?? 'Page')

@section('content-container')

    <div class="sk-spinner sk-spinner-double-bounce">
        <div class="sk-double-bounce1"></div>
        <div class="sk-double-bounce2"></div>
    </div>

    <div class="edit-form form-horizontal">
        @include('_partials.form.fields', ['fields' => $fields])
    </div>
    <a class="btn btn-primary {{$buttonUpdateClass}}" href={{$buttonUrl}}>Обновить</a>
@endsection