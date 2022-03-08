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

    {{-- Area --}}
    @if (Auth::user()->isAdmin())
        <x-inputs.group class="col-sm-12">
            <x-inputs.select name="area_id" label="Área" required>
                @php $selected = old('area_id', ($editing ? $user->area_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el área</option>
                @foreach($areas as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>
    @elseif (Auth::user()->isJefeArea())
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="area_id" label="Área" required>
            @php $selected = old('area_id', ($editing ? $user->area_id : '')) @endphp
            <option value="{{ Auth::user()->area->id }}" selected >{{ Auth::user()->area->name }}</option>
        </x-inputs.select>
    </x-inputs.group>
    @endif

    {{-- Rol --}}
    @if (Auth::user()->isAdmin())
        <x-inputs.group class="col-sm-12">
            <x-inputs.select name="rol_id" label="Rol" required>
                @php $selected = old('rol_id', ($editing ? $user->roles->pluck('id')->first() : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el rol</option>
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>
    @elseif (Auth::user()->isJefeArea())
        <x-inputs.group class="col-sm-12">
            <x-inputs.select name="rol_id" label="Rol" required>
                @php $selected = old('rol_id', ($editing ? $user->roles->pluck('id')->first() : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el rol</option>
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>
    @endif
    
</div>
