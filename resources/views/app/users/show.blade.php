@extends('adminlte::page')

@section('title', 'GestionCalidad | Mostrar Usuario')

@section('content_header')
    Mostrar Usuario
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h5>Nombre</h5>
                    <span>{{ $user->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Correo</h5>
                    <span>{{ $user->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Area</h5>
                    <span>{{ optional($user->area)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>Roles</h5>
                    <div>
                        @forelse ($user->roles as $role)
                        <div class="badge badge-primary">{{ $role->name }}</div>
                        <br />
                        @empty - @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>

                @can('create', App\Models\User::class)
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Nuevo
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
