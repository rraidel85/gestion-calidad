@extends('adminlte::page')

@section('title', 'GestionCalidad | Editar Documento')

@section('content_header')
    Editar documento
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="PUT"
                action="{{ route('files.update', $file) }}"
                has-files
                class="mt-4"
            >
                @include('app.files.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('files.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left text-primary"></i>
                        Volver
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        Actualizar
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
