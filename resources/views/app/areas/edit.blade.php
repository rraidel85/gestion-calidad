@extends('adminlte::page')

@section('title', 'Editar Area')

@section('content_header')
    Editar Area
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
           

            <x-form
                method="PUT"
                action="{{ route('areas.update', $area) }}"
                class="mt-4"
            >
                @include('app.areas.form-inputs')

                <div class="mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-light">
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
