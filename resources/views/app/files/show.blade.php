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
                    <h5>Nombre</h5>
                    <span>{{ $file->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Documento</h5>
                    @if($file->file)
                    <a href="{{ \Storage::url($file->file) }}" target="blank"
                        ><i class="fa fa-download"></i>&nbsp;Download</a
                    >
                    @else - @endif
                </div>
                <div class="mb-4">
                    <h5>Categoria</h5>
                    <span>{{ optional($file->category)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Area</h5>
                    <span>{{ optional($file->area)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Usuario</h5>
                    <span>{{ optional($file->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('files.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>

                @can('create', App\Models\File::class)
                <a href="{{ route('files.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> Nuevo
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
