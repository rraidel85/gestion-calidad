@extends('adminlte::page')

@section('title', 'Crear Categoría')

@section('content_header')
    <h1>Crear Categoría</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="POST"
                action="{{ route('categories.store') }}"
                class="mt-4"
            >
                @include('app.categories.form-inputs')

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
