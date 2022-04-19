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
                    <h4 style="font-weight: 600;">Nombre:</h4>
                    <span style="font-size: 18px;">{{ $role->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Permisos:</h4>
                    @foreach ($permissions as $permission)
                        <span style="font-size: 18px;">-{{ $permission->name ?? '-' }}</span><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
