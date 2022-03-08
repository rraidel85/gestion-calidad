@extends('adminlte::page')

@section('title', 'Mostrar Área')

@section('content_header')
    <h1>Mostrar Área</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Nombre:</h4>
                    <span style="font-size: 18px;">{{ $area->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Descripción:</h4>
                    <span style="font-size: 18px;">{{ $area->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Tipo de área:</h4>
                    <span style="font-size: 18px;">{{ optional($area->typeArea)->name ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
