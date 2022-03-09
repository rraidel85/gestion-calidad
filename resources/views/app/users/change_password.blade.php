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
                            id="oldpassword"
                            name="oldpassword"
                            label="Contraseña actual"
                            required
                        ></x-inputs.password>
                        <div style="margin-top:5px" class="form-check">
                            <input onclick="showPassword('oldpassword')" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Mostrar contraseña
                            </label>
                        </div>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.password
                            id="password"
                            name="password"
                            label="Nueva contraseña"
                            required
                        ></x-inputs.password>
                        <div style="margin-top:5px" class="form-check">
                            <input onclick="showPassword('password')" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Mostrar contraseña
                            </label>
                        </div>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.password
                            id="password_confirmation"
                            name="password_confirmation"
                            label="Confirmar contraseña"
                            required
                        ></x-inputs.password>
                        <div style="margin-top:5px" class="form-check">
                            <input onclick="showPassword('password_confirmation')" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Mostrar contraseña
                            </label>
                        </div>
                    </x-inputs.group>

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

@section('js')
    <script>
        function showPassword(element) {
        var checkb = document.getElementById(element);
        if (checkb.type === "password") {
            checkb.type = "text";
        }
        else {
            checkb.type = "password";
        }
    }
    </script>
@stop