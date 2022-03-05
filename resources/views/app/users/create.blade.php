@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    Crear Usuario
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="POST"
                action="{{ route('users.store') }}"
                class="mt-4"
            >
                @include('app.users.form-inputs')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary float-right save-btn">
                        <i class="fas fa-save"></i>
                        Crear
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
