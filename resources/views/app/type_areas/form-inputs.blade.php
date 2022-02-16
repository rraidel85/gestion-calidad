@php $editing = isset($typeArea) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre"
            value="{{ old('name', ($editing ? $typeArea->name : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
