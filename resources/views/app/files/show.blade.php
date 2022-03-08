@extends('adminlte::page')

@section('title', 'Mostrar Documento')

@section('content_header')
    Mostrar Documento
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h5>Nombre:</h5>
                    <span>{{ $file->name ?? '-' }}</span>
                </div>
                
                <div class="mb-4">
                    <h5>Area:</h5>
                    <span>{{ optional($file->area)->name ?? '-' }}</span>
                </div>
                @can('seeOwner', $file)
                <div class="mb-4">
                    <h5>Subido por:</h5>
                    <span>{{ optional($file->user)->name ?? '-' }}</span>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
