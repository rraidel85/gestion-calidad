@extends('adminlte::page')

@section('title', 'Areas')

@section('content_header')
    <h1>Areas</h1>
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            
            <div class="row create-row">
                <div class="col-md-6 text-left create-btn-father">
                    @can('create', App\Models\Area::class)
                    <a
                        href="{{ route('areas.create') }}"
                        class="btn btn-primary create-btn"
                    >
                        <i class="fas fa-plus"></i>
                        Nueva Area
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
                            <th class="text-left">
                                Descripción
                            </th>
                            <th class="text-left">
                                Tipo Area
                            </th>
                            <th class="text-center">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($areas as $area)
                        <tr>
                            <td>{{ $area->name ?? '-' }}</td>
                            <td>{{ $area->description ?? '-' }}</td>
                            <td>
                                {{ optional($area->typeArea)->name ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $area)
                                    <a href="{{ route('areas.edit', $area) }}">
                                        <button
                                            type="button"
                                            class="btn btn-info edit-btn my-btns"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $area)
                                    <a href="{{ route('areas.show', $area) }}">
                                        <button
                                            type="button"
                                            class="btn btn-success show-btn my-btns"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $area)
                                    <form
                                        action="{{ route('areas.destroy', $area) }}"
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
