@extends('adminlte::page')

@section('title', 'Mostrar Roles')

@section('content_header')
    Mostrar Roles
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h5>Nombre</h5>
                    <span>{{ $role->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('roles.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>

                @can('create', App\Models\Role::class)
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Nuevo
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
