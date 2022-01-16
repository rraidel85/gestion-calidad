@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('files.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.files.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.files.inputs.name')</h5>
                    <span>{{ $file->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.files.inputs.file')</h5>
                    @if($file->file)
                    <a href="{{ \Storage::url($file->file) }}" target="blank"
                        ><i class="icon ion-md-download"></i>&nbsp;Download</a
                    >
                    @else - @endif
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.files.inputs.category_id')</h5>
                    <span>{{ optional($file->category)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.files.inputs.access_level')</h5>
                    <span>{{ $file->access_level ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.files.inputs.area_id')</h5>
                    <span>{{ optional($file->area)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.files.inputs.user_id')</h5>
                    <span>{{ optional($file->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('files.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\File::class)
                <a href="{{ route('files.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
