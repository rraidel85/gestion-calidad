@extends('adminlte::page')

@section('title', 'Editar Área')

@section('content_header')
<h1>Editar Área</h1>
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
