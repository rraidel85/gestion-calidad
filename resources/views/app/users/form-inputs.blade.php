@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $user->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $user->email : '')) }}"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="level"
            label="Level"
            value="{{ old('level', ($editing ? $user->level : '')) }}"
            max="255"
            placeholder="Level"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="areas[]" label="Area" required multiple>
            @php $selected = old('area_id', ($editing ? $user->area_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Area</option>
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin'))
                @foreach($areas as $area)
                    <option
                        value="{{ $area->id }}" {{ $editing && $user->areas->contains($area) ? 'selected' : '' }}
                    >{{ $area->name }}</option>
                @endforeach
            @else
                @foreach(\Illuminate\Support\Facades\Auth::user()->areas as $area)
                    <option
                        value="{{ $area->id }}" {{ $editing && $user->areas->contains($area) ? 'selected' : '' }}
                    >{{ $area->name }}</option>
                @endforeach
            @endif
        </x-inputs.select>
    </x-inputs.group>
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin'))
    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.roles.name')</h4>

        @foreach ($roles as $role)
            <div>
                <x-inputs.checkbox
                    id="role{{ $role->id }}"
                    name="roles[]"
                    label="{{ ucfirst($role->name) }}"
                    value="{{ $role->id }}"
                    :checked="isset($user) ? $user->hasRole($role) : false"
                    :add-hidden-value="false"
                ></x-inputs.checkbox>
            </div>
        @endforeach
    </div>
    @else
        <input type="hidden" name="roles[]" value="{{$roles[0]->id}}">
    @endif

</div>
