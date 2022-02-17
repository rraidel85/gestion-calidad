@extends('adminlte::page')

@section('title', 'Crear Area')

@section('content_header')
    Crear Area
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
                    <a href="{{ url()->previous() }}" class="btn btn-light">
                        <i class="fas fa-arrow-left text-primary"></i>
                        Volver
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        Crear
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
