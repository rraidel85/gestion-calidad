@extends('adminlte::page')

@section('title', 'Editar Roles')

@section('content_header')
    <h1>Editar Roles</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="PUT"
                action="{{ route('roles.update', $role) }}"
                class="mt-4"
            >
                @include('app.roles.form-inputs')

                <div class="mt-4">
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
