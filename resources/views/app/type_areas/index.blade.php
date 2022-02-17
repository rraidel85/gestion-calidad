@extends('adminlte::page')

@section('title', 'Tipos de area')

@section('content_header')
    <h1>Tipos de area</h1>
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

                <div class="row">
                    <div class="col-md-6 text-left">
                        @can('create', App\Models\TypeArea::class)
                        <a
                            href="{{ route('type-areas.create') }}"
                            class="btn btn-primary create-btn"
                        >
                            <i class="fas fa-plus"></i>
                            Nuevo Tipo de Area
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
                        @foreach($typeAreas as $typeArea)
                        <tr>
                            <td>{{ $typeArea->name ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $typeArea)
                                    <a
                                        href="{{ route('type-areas.edit', $typeArea) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-info edit-btn my-btns"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $typeArea)
                                    <a
                                        href="{{ route('type-areas.show', $typeArea) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success show-btn my-btns"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $typeArea)
                                    <form
                                        action="{{ route('type-areas.destroy', $typeArea) }}"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
