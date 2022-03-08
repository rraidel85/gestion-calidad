@extends('adminlte::page')

@section('title', 'Mostrar Usuario')

@section('content_header')
    <h1>Mostrar Usuario</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Nombre</h4>
                    <span style="font-size: 18px;">{{ $user->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Correo</h4>
                    <span style="font-size: 18px;">{{ $user->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Area</h4>
                    <span style="font-size: 18px;">{{ optional($user->area)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Roles</h4>
                    <div>
                        @forelse ($user->roles as $role)
                        <div class="badge badge-primary">{{ $role->name }}</div>
                        <br />
                        @empty - @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-4">
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
