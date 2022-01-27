@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('areas.index') }}" class="mr-4"
                    ><i class="fas fa-arrow-left"></i
                ></a>
                @lang('crud.areas.create_title')
            </h4>

            <x-form
                method="POST"
                action="{{ route('areas.store') }}"
                class="mt-4"
            >
                @include('app.areas.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('areas.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
