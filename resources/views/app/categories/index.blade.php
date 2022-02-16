@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 text-left create-btn">
                    @can('create', App\Models\Category::class)
                    <a
                        href="{{ route('categories.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="fas fa-plus"></i>
                        Nueva Categoría
                    </a>
                    @endcan
                </div>
            </div>
            

            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped table-bordered">
                    <thead class="my-thead">
                        <tr>
                            <th class="text-left">
                                Nombre
                            </th>
                            <th class="text-center">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $category)
                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary edit-btn my-btns"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $category)
                                    <a
                                        href="{{ route('categories.show', $category) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success show-btn my-btns"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $category)
                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="delete_element(event)"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger delete-btn my-btns"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">
                                Ningún registro encontrado
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
