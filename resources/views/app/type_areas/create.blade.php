@extends('adminlte::page')

@section('title', 'Crear Tipo-Area')

@section('content_header')
    <h1>Crear Tipo de Area</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="POST"
                action="{{ route('type-areas.store') }}"
                class="mt-4"
            >
                @include('app.type_areas.form-inputs')

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
