@extends('layouts.app')
{{-- MENSAJES B2F --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ $action ?? '#' }}">

    @csrf

    {{-- NOMBRE --}}
    <div class="mb-3">
        <label class="form-label-custom">Nombre *</label>

        <input type="text"
               name="nombre"
               class="form-control-custom"
               value="{{ old('nombre', $departamento->nombre ?? '') }}"
               required>
    </div>

    {{-- CODIGO --}}
    <div class="mb-3">
        <label class="form-label-custom">Código *</label>

        <input type="text"
               name="codigo"
               class="form-control-custom"
               value="{{ old('codigo', $departamento->codigo ?? '') }}"
               required>
    </div>

    {{-- DESCRIPCION --}}
    <div class="mb-3">
        <label class="form-label-custom">Descripción</label>

        <textarea name="descripcion"
                  class="form-control-custom">{{ old('descripcion', $departamento->descripcion ?? '') }}</textarea>
    </div>

    {{-- FUNCION PRINCIPAL --}}
    <div class="mb-3">
        <label class="form-label-custom">Función Principal *</label>

        <input type="text"
               name="funcion_principal"
               class="form-control-custom"
               value="{{ old('funcion_principal', $departamento->funcion_principal ?? '') }}"
               required>
    </div>

    {{-- DEPARTAMENTO PADRE --}}
    <div class="mb-3">
        <label class="form-label-custom">Departamento Padre</label>

        <select name="departamento_padre_id"
                class="form-select-custom">

            <option value="">Ninguno</option>
            <option value="1">dato de prueba 1</option>
            <option value="2">dato de prueba 2</option>


        </select>
    </div>

    {{-- BOTONES --}}
    <div class="modal-actions-container d-flex justify-content-end gap-2">

        <button type="button"
                class="btn-cancel-custom">
            Cancelar
        </button>

        <button type="submit"
                class="btn-create-custom">
            Guardar
        </button>

    </div>

</form>