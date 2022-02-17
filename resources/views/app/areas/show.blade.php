@extends('adminlte::page')

@section('title', 'Mostrar Area')

@section('content_header')
    Mostrar Area
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h5>Nombre</h5>
                    <span>{{ $area->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Descripcion</h5>
                    <span>{{ $area->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Tipo de Area</h5>
                    <span>{{ optional($area->typeArea)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>

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
