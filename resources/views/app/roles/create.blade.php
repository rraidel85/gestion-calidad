@extends('adminlte::page')

@section('title', 'GestionCalidad | Crear Roles')

@section('content_header')
    Crear Roles
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="POST"
                action="{{ route('roles.store') }}"
                class="mt-4"
            >
                @include('app.roles.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('roles.index') }}" class="btn btn-light">
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
