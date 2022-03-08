@php $editing = isset($file) @endphp

<div class="row">

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="file"
            label="{{ $editing ? 'Cambiar documento:' : 'Documento:'}}"
        ></x-inputs.partials.label
        ><br />

        <input type="file" onChange='changeNameInputValue()' name="file" id="file" class="form-control-file" />

       @error('file') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre:"
            value="{{ old('name', ($editing ? $file->name : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            id="name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <div class="form-group col-sm-12 category-filter">
        <label>Categoría(s):</label>
        <div class="select2-purple">
            <select name="categories[]" class="select2" id="categorySelect" multiple="multiple" style="width: 100%;">
                @foreach ($categories as $category)
                    <option value={{ $category->id }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @error('categories') @include('components.inputs.partials.error')
        @enderror
    </div>   
    
</div>
