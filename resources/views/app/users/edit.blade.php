@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    Editar Usuario
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="PUT"
                action="{{ route('users.update', $user) }}"
                class="mt-4"
            >
                @include('app.users.form-inputs')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary float-right save-btn">
                        <i class="fas fa-save"></i>
                        Actualizar
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
