@extends('adminlte::page')

@section('title', 'GestionCalidad | Documentos')

@section('content_header')
    <h1>Documentos</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\File::class)
                        <a
                            href="{{ route('files.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            Nuevo Documento
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                Nombre
                            </th>
                            <th class="text-left">
                                Archivo
                            </th>
                            <th class="text-left">
                                Categoría
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
<<<<<<< HEAD
                        <tr>
                            <td>{{ $file->name ?? '-' }}</td>
                            <td>
                                @if($file->file)
                                <a
                                    href="{{ \Storage::url($file->file) }}"
                                    target="blank"
                                    ><i class="fa fa-download"></i
                                    >&nbsp;Descargar</a 
                                >
                                @else - @endif
                            </td>
                            <td>
                                {{ optional($file->category)->name ?? '-' }}
                            </td>
                            <td>{{ optional($file->area)->name ?? '-' }}</td>
                            <td>{{ optional($file->user)->name ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $file)
                                    <a href="{{ route('files.edit', $file) }}">
                                        <button
                                            type="button"
                                            class="btn btn-info"
=======
                            <tr>
                                <td>{{ $file->name ?? '-' }}</td>
                                <td>
                                    @if($file->file)
                                        <a
                                            href="{{ route('files.download', $file->id) }}"
                                            target="blank"
                                        ><i class="icon ion-md-download"></i
                                            >&nbsp;Download</a
>>>>>>> 9b45d42 (Change download way creating a 'download' method in FileController)
                                        >
                                            <i class="fas fa-edit"></i> 
                                        </button>
                                    </a>
                                    @endcan @can('view', $file)
                                    <a href="{{ route('files.show', $file) }}">
                                        <button
                                            type="button"
                                            class="btn btn-success"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $file)
                                    <form
                                        action="{{ route('files.destroy', $file) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger"
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
                            <td colspan="6">
                                Ningún registro encontrado
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">{!! $files->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
