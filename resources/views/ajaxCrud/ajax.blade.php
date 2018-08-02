@extends('layout.master')
@section('css')
    <style>
        .loading {
            background: #c9e2b3;
            padding: 15px;
            position: fixed;
            border-radius: 10px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }

        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div id="content">
        @include('ajaxCrud.index')
    </div>
    <div class="loading">
        <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>
        <br>
        <span>Загрузка..</span>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/ajax.js') }}"></script>
@endsection

