@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Documentos</h1>
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="form-group category-filter-create-btn">
                <div class="category-filter">
                    <label>Selecciona las categorías a filtrar:</label>
                    <div class="select2-purple">
                        <select class="select2" id="categorySelect" data-routeaction="{{ Route::currentRouteAction() }}" onchange="get_files_by_category(this)" multiple="multiple" style="width: 100%;">
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>   
                <div class="">
                    <div class="text-right">
                        @can('create', App\Models\File::class)
                        <a
                            href="{{ route('files.create') }}"
                            class="btn btn-primary create-btn-files"
                        >
                            <i class="fas fa-plus"></i>
                            Nuevo Documento
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped table-bordered">
                    <thead class="my-thead">
                        <tr>
                            <th class="text-left">
                                Nombre
                            </th>
                            <th class="text-left">
                                Area
                            </th>
                            <th class="text-left">
                                Creado por
                            </th>
                            <th class="text-center">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                        <tr>
                            <td>{{ $file->name ?? '-' }}</td>
                            <td>{{ optional($file->area)->name ?? '-' }}</td>
                            <td>{{ optional($file->user)->name ?? '-' }}</td>
                            <td class="options-btn text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    <a class="anchor-download-btn" onclick="checkFileExists(event,'{{ $file->file }}')" 
                                        href="{{ route('files.download', $file->id) }}">
                                        <button title="Descargar"
                                            type="button"
                                            class="btn btn-info download-btn my-btns"
                                        >
                                            <i class="fas fa-download"></i> 
                                        </button>
                                    </a>
                                    @can('update', $file)
                                    <a href="{{ route('files.edit', $file) }}">
                                        <button title="Editar"
                                            type="button"
                                            class="btn btn-info edit-btn my-btns"
                                        >
                                            <i class="fas fa-edit"></i> 
                                        </button>
                                    </a>
                                    @endcan 
                                    <a href="{{ route('files.show', $file) }}">
                                        <button title="Mostrar"
                                            type="button"
                                            class="btn btn-success show-btn my-btns"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @can('delete', $file)
                                    <form 
                                        action="{{ route('files.destroy', $file) }}"
                                        method="POST"
                                        onsubmit="delete_element(event)"
                                    >
                                        @csrf @method('DELETE')
                                        <button title="Eliminar"
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
                            <td id="empty-table" colspan="6">
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


