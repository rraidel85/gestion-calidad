@extends('adminlte::page')

@section('title', 'Editar Categoría')

@section('content_header')
    Editar Categoría
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            

            <x-form
                method="PUT"
                action="{{ route('categories.update', $category) }}"
                class="mt-4"
            >
                @include('app.categories.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ url()->previous() }}"
                        class="btn btn-light"
                    >
                        <i class="fas fa-arrow-left text-primary"></i>
                        Volver
                    </a>

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
