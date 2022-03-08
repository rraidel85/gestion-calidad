@extends('adminlte::page')

@section('title', 'Mostrar Tipo-área')

@section('content_header')
    <h1>Mostrar Tipo de área</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Nombre:</h4>
                    <span style="font-size: 18px;">{{ $typeArea->name ?? '-' }}</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
