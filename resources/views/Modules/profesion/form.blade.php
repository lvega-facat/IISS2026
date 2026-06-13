@extends('layouts.app')

{{-- Esta vista se reutiliza para CREAR y EDITAR.
     Si existe $profesion -> estamos editando; si no -> estamos creando. --}}
@section('title', isset($profesion) ? 'Editar Profesión' : 'Nueva Profesión')

@section('content')
    <style>
        .prof-form-wrap { max-width: 560px; margin: 0 auto; }
        .prof-form-wrap label { display: block; font-size: 13px; color: #374151; margin: 14px 0 4px; }
        .prof-form-wrap input[type=text],
        .prof-form-wrap textarea { width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-family: inherit; }
        .prof-form-wrap textarea { min-height: 90px; }
        .req { color: #dc2626; }
        .prof-actions { margin-top: 20px; display: flex; gap: 10px; }
        .prof-btn { padding: 9px 16px; border: 1px solid #2563eb; background: #2563eb; color: #fff; border-radius: 6px; text-decoration: none; font-size: 14px; cursor: pointer; }
        .prof-btn-cancel { background: #fff; color: #374151; border-color: #ccc; }
        .error { color: #dc2626; font-size: 12px; margin-top: 4px; }
    </style>

    <div class="prof-form-wrap">
        <h2>{{ isset($profesion) ? 'Editar Profesión' : 'Nueva Profesión' }}</h2>

        {{-- En el sistema real:
             - crear  -> action = ruta store,  method POST
             - editar -> action = ruta update, method POST + @method('PUT') --}}
        <form method="POST" action="#">
            @csrf
            @isset($profesion)
                @method('PUT')
            @endisset

            <label for="nombre">Nombre <span class="req">*</span></label>
            <input type="text" id="nombre" name="nombre"
                   value="{{ old('nombre', $profesion['nombre'] ?? '') }}" required>
            @error('nombre')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion">{{ old('descripcion', $profesion['descripcion'] ?? '') }}</textarea>
            @error('descripcion')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="prof-actions">
                <button type="submit" class="prof-btn">Guardar</button>
                <a href="{{ url('/dev/profesion') }}" class="prof-btn prof-btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
