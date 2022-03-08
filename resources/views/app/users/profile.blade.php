@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4>Nombre:</h4>
                    <span>{{ $user->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4>Correo:</h4>
                    <span>{{ $user->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h4>Área:</h4>
                    <span>{{ optional($user->area)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <div class="mb-4">
                    <h4>Rol:</h4>
                    <div>
                        @forelse ($user->roles as $role)
                        <div class="rol badge badge-primary">{{ $role->name }}</div>
                        <br />
                        @empty - @endforelse
                    </div>
                </div>
            </div>
            
            <a href="{{ route('user.change_password') }}" class="change-password btn btn-success">
                <i class="fa fa-lock" aria-hidden="true"></i>
                Cambiar contraseña
            </a>
        </div>
    </div>
</div>
@endsection
