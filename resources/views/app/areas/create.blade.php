@extends('adminlte::page')

@section('title', 'Crear Área')

@section('content_header')
    <h1>Crear Área</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            

            <x-form
                method="POST"
                action="{{ route('areas.store') }}"
                class="mt-4"
            >
                @include('app.areas.form-inputs')

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
