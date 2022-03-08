@extends('adminlte::page')

@section('title', 'Mostrar Categorías')

@section('content_header')
    <h1>Mostrar Categorías</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">Nombre:</h4>
                    <span style="font-size: 18px;">{{ $category->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mb-4">
                <h4 style="font-weight: 600;">Documentos:</h4>
                @foreach ($category_files as $file)
                    <span style="font-size: 18px;display: block;">-{{ $file->name ?? '-' }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
