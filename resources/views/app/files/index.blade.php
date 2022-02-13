@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Documentos</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <label>Selecciona las categorías a filtrar</label>
                <div class="select2-purple">
                    <select class="select2" id="categorySelect" onchange="get_files_by_category()" multiple="multiple" style="width: 70%;">
                        @foreach ($categories as $category)
                            <option value={{ $category->id }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mb-2">
                <div class="row father-create">
                    <div class="text-right">
                        @can('create', App\Models\File::class)
                        <a
                            href="{{ route('files.create') }}"
                            class="btn btn-primary create"
                        >
                            <i class="icon ion-md-add"></i>
                            Nuevo Documento
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="table-file" class="table table-sm table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-left">
                                Nombre
                            </th>
                            <th class="text-left">
                                Archivo
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
                            <td>
                                @if($file->file)
                                <a
                                    href="{{ route('files.download', $file->id) }}"
                                    target="blank"
                                    ><i class="fa fa-download"></i
                                    >&nbsp;Descargar</a 
                                >
                                @else - @endif
                            </td>
                            <td>{{ optional($file->area)->name ?? '-' }}</td>
                            <td>{{ optional($file->user)->name ?? '-' }}</td>
                            <td class="options-btn text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    <a href="{{ route('files.edit', $file) }}">
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
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
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

@section('js')
    <script src="/js/admin_custom.js"></script>
@stop
