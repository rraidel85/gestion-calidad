@extends('adminlte::page')

@section('title', 'Mostrar Area')

@section('content_header')
    <h1>Mostrar Area</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4>Nombre</h4>
                    <span>{{ $area->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4>Descripcion</h4>
                    <span>{{ $area->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4>Tipo de Area</h4>
                    <span>{{ optional($area->typeArea)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                @can('create', App\Models\Area::class)
                <a href="{{ route('areas.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Nuevo
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
