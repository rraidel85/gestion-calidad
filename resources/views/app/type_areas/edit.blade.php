@extends('adminlte::page')

@section('title', 'Editar Tipo-Area')

@section('content_header')
    Editar Tipo de Area
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <x-form
                method="PUT"
                action="{{ route('type-areas.update', $typeArea) }}"
                class="mt-4"
            >
                @include('app.type_areas.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ url()->previous() }}"
                        class="btn btn-light"
                    >
                        <i class="fas fa-arrow-left text-primary"></i>
                        Volver
                    </a>

                    <a
                        href="{{ route('type-areas.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        Actualizar
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
