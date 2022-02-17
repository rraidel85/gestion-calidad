@extends('adminlte::page')

@section('title', 'Mostrar Tipo-Area')

@section('content_header')
    Mostrar Tipo de Area
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('type-areas.index') }}" class="mr-4"
                    ><i class="fas fa-arrow-left"></i
                ></a>
                @lang('crud.type_areas.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>Nombre</h5>
                    <span>{{ $typeArea->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
