@extends('adminlte::page')

@section('title', 'Mostrar Roles')

@section('content_header')
    <h1>Mostrar Roles</h1>
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Nombre</h4>
                    <span style="font-size: 18px;">{{ $role->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
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
