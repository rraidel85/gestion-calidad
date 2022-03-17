@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

                <div class="row create-row">
                    
                    <div class="col-md-6 text-left create-btn-father">
                        @can('create', App\Models\Role::class)
                        <a
                            href="{{ route('roles.create') }}"
                            class="btn btn-primary create-btn"
                        >
                            <i class="icon ion-md-add"></i>
                            Nuevo Rol
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
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $role)
                                    <a href="{{ route('roles.edit', $role) }}">
                                        <button
                                            type="button"
                                            class="btn btn-info edit-btn my-btns"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $role)
                                    <a href="{{ route('roles.show', $role) }}">
                                        <button
                                            type="button"
                                            class="btn btn-success show-btn my-btns"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $role)
                                    <form
                                        action="{{ route('roles.destroy', $role) }}"
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
