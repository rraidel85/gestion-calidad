@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
                <div class="row create-row">
                    <div class="col-md-6 text-left create-btn-father">
                        @can('create', App\Models\User::class)
                        <a
                            href="{{ route('users.create') }}"
                            class="btn btn-primary create-btn"
                        >
                            <i class="fas fa-plus"></i>
                            Nuevo Usuario
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
                                Correo
                            </th>
                            <th class="text-left">
                                Área
                            </th>
                            <th class="text-left">
                                Rol
                            </th>
                            <th class="text-center">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name ?? '-' }}</td>
                            <td>{{ $user->email ?? '-' }}</td>
                            <td>{{ optional($user->area)->name ?? '-' }}</td>
                            <td>{{ $user->roles->first->name->name ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $user)
                                    <a href="{{ route('users.edit', $user) }}">
                                        <button
                                            type="button"
                                            class="btn btn-primary edit-btn my-btns"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $user)
                                    <a href="{{ route('users.show', $user) }}">
                                        <button
                                            type="button"
                                            class="btn btn-success show-btn my-btns"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $user)
                                    <form
                                        action="{{ route('users.destroy', $user) }}"
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

