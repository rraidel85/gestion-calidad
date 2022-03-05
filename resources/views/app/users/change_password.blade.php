@extends('adminlte::page')

@section('title', 'Cambiar Contraseña')

@section('content_header')
    <h1>Cambiar Contraseña</h1>
@stop

@section('css')
    <style>
        .form-group{
            width: 90% !important;
            margin-bottom: 25px;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <x-form method="POST" class="mt-4"
                    action="{{ route('user.store_password') }}">
                    
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.password
                            name="oldpassword"
                            label="Contraseña vieja"
                            required
                        ></x-inputs.password>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.password
                            name="password"
                            label="Nueva contraseña"
                            required
                        ></x-inputs.password>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.password
                            name="password_confirmation"
                            label="Confirmar contraseña"
                            required
                        ></x-inputs.password>
                    </x-inputs.group>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection