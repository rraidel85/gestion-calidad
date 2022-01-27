@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('areas.index') }}" class="mr-4"
                    ><i class="fas fa-arrow-left"></i
                ></a>
                @lang('crud.areas.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.areas.inputs.name')</h5>
                    <span>{{ $area->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.areas.inputs.description')</h5>
                    <span>{{ $area->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.areas.inputs.type_area_id')</h5>
                    <span>{{ optional($area->typeArea)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('areas.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Area::class)
                <a href="{{ route('areas.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
