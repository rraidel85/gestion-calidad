@extends('adminlte::page')

@section('title', 'Crear Tipo-Area')

@section('content_header')
    Crear Tipo de Area
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="POST"
                action="{{ route('type-areas.store') }}"
                class="mt-4"
            >
                @include('app.type_areas.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('type-areas.index') }}"
                        class="btn btn-light"
                    >
                        <i class="fas fa-arrow-left text-primary"></i>
                        Volver
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        Crear
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
