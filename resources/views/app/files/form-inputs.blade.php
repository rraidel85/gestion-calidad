@php $editing = isset($file) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $file->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="file"
            label="File"
        ></x-inputs.partials.label
        >
        <br/>

        <input type="file" name="file" id="file" class="form-control-file"/>

        @if($editing && $file->file)
            <div class="mt-2">
                <a href="{{ \Storage::url($file->file) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
                >
            </div>
        @endif @error('file') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="category_id" label="Category" required>
            @php $selected = old('category_id', ($editing ? $file->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category</option>
            @foreach($categories as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['super-admin']))
        <x-inputs.group class="col-sm-12">
            <x-inputs.number
                name="access_level"
                label="Access Level"
                value="{{ old('access_level', ($editing ? $file->access_level : '')) }}"
                min="1"
                max="10"
                step="1"
                placeholder="Access Level"
                required
            ></x-inputs.number>
        </x-inputs.group>
    @else
        <input type="hidden" name="access_level" value="{{\Illuminate\Support\Facades\Auth::user()->level}}">
    @endif

    @if(count(\Illuminate\Support\Facades\Auth::user()->areas) !== 1 )
        <x-inputs.group class="col-sm-12">
            <x-inputs.select name="area_id" label="Area" required>
                @php $selected = old('area_id', ($editing ? $file->area_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Area</option>
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin'))

                    @foreach($areas as $value => $label)
                        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                    @endforeach
                @else
                    @foreach(\Illuminate\Support\Facades\Auth::user()->areas as $area)
                        <option
                            value="{{ $area->id }}" {{ $selected == $area->id ? 'selected' : '' }} >{{ $area->name }}</option>
                    @endforeach
                @endif
            </x-inputs.select>
        </x-inputs.group>
    @else
        <input type="hidden" name="area_id" value="{{\Illuminate\Support\Facades\Auth::user()->areas[0]->id}}">
    @endif

    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin'))
        <x-inputs.group class="col-sm-12">
            <x-inputs.select name="user_id" label="User" required>
                @php $selected = old('user_id', ($editing ? $file->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>
    @else
        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
    @endif
</div>
