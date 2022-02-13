@extends('adminlte::page')

@section('title', 'Inicio')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    @auth
        <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    @endauth
    @guest
        <h1>Bienvenido, Invitado</h1>
    @endguest
@stop

@section('content')

@endsection

@section('js')
    <script src="/js/admin_custom.js"></script>
@stop
