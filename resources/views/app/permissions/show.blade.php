@extends('adminlte::page')

@section('title', 'GestionCalidad | Mostrar Permiso')

@section('content_header')
    Mostrar Permiso
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('permissions.index') }}" class="mr-4"
                    ><i class="fas fa-arrow-left"></i
                ></a>
                @lang('crud.permissions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h4 style="font-weight: 600;">@lang('crud.permissions.inputs.name')</h4>
                    <span style="font-size: 18px;">{{ $permission->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('permissions.index') }}"
                    class="btn btn-light"
                >
                    <i class="fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Permission::class)
                <a
                    href="{{ route('permissions.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
