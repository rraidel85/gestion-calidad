@extends('adminlte::page')

@section('title', 'Mostrar Documento')

@section('content_header')
    <h1>Mostrar Documento</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Nombre:</h4>
                    <span style="font-size: 18px;">{{ $file->name ?? '-' }}</span>
                </div>
                
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Área:</h4>
                    <span style="font-size: 18px;">{{ optional($file->area)->name ?? '-' }}</span>
                </div>
                @can('seeOwner', $file)
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Subido por:</h4>
                    <span style="font-size: 18px;">{{ optional($file->user)->name ?? '-' }}</span>
                </div>
                @endcan
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Categorías:</h4>
                    @foreach ($file_categories as $category)
                        <span style="font-size: 18px;display: block;">-{{ $category->name ?? '-' }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
