@extends('adminlte::page')

@section('title', 'Crear Documento')

@section('content_header')
    <h1>Subir documento</h1>
@stop
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="POST"
                action="{{ route('files.store') }}"
                has-files
                class="mt-4"
            >
                @include('app.files.form-inputs')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary float-right save-btn">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
