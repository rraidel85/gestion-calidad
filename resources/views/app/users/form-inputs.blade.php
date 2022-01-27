@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $user->name : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Correo"
            value="{{ old('email', ($editing ? $user->email : '')) }}"
            maxlength="255"
            placeholder="Correo"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Contraseña"
            maxlength="255"
            placeholder="Contraseña"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="area_id" label="Area" required>
            @php $selected = old('area_id', ($editing ? $user->area_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione el area</option>
            @foreach($areas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4>Asignar roles</h4>

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
</div>
