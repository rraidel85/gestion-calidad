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
                    <h4>Nombre</h4>
                    <span>{{ $category->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                @can('create', App\Models\Category::class)
                <a
                    href="{{ route('categories.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> Nuevo
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
