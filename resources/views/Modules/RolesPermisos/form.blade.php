@extends('layouts.app')

@section('title', isset($rol) ? 'Editar Rol' : 'Nuevo Rol')

@section('page-title', 'Roles y Permisos')
@section('page-subtitle', isset($rol) ? 'Modificar datos del rol existente' : 'Registrar un nuevo rol en el sistema')

@section('content')

<div class="roles-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1 fw-bold text-dark">
                    {{ isset($rol) ? 'Editar Rol' : 'Nuevo Rol' }}
                </h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    {{ isset($rol) ? 'Modificá los datos del rol seleccionado' : 'Completá los campos para registrar un nuevo rol' }}
                </p>
            </div>
            <a href="{{ route('roles.index') }}" class="btn-back-link">
                <i class="fa fa-arrow-left me-2"></i>Volver al listado
            </a>
        </div>
    </div>

    {{-- ALERTA DE ERROR GLOBAL --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #fee2e2; color: #991b1b; font-size: 0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERTA DE ÉXITO --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #d1fae5; color: #065f46; font-size: 0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <div class="card form-card">
        <div class="card-body px-4 py-4">

            <form
                method="POST"
                action="{{ isset($rol) ? route('roles.update', $rol->id) : route('roles.store') }}"
                id="rolForm"
            >
                @csrf
                @if(isset($rol))
                    @method('PUT')
                @endif

                {{-- SECCIÓN: INFORMACIÓN GENERAL --}}
                <div class="form-section-title">Información General</div>

                <div class="row g-4">

                    {{-- Nombre del Rol --}}
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label-custom">
                            Nombre del Rol <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control-custom @error('nombre') is-invalid-custom @enderror"
                            placeholder="Ej: Administrador, Supervisor..."
                            value="{{ old('nombre', $rol->nombre ?? '') }}"
                            maxlength="100"
                        >
                        @error('nombre')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="col-12 col-md-6">
                        <label for="estado" class="form-label-custom">
                            Estado <span class="text-danger">*</span>
                        </label>
                        <select
                            id="estado"
                            name="estado"
                            class="form-control-custom form-select-custom @error('estado') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná un estado</option>
                            <option value="1" {{ old('estado', $rol->estado ?? '') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $rol->estado ?? '') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="col-12">
                        <label for="descripcion" class="form-label-custom">
                            Descripción
                        </label>
                        <textarea
                            id="descripcion"
                            name="descripcion"
                            class="form-control-custom form-textarea-custom @error('descripcion') is-invalid-custom @enderror"
                            placeholder="Describí brevemente las responsabilidades de este rol..."
                            rows="4"
                            maxlength="500"
                        >{{ old('descripcion', $rol->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <div class="field-hint">Máximo 500 caracteres.</div>
                    </div>

                </div>

                {{-- SEPARADOR --}}
                <hr class="form-divider">

                {{-- BOTONERA --}}
                <div class="form-actions">

                    <a href="{{ route('roles.index') }}" class="btn-cancel-custom">
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn-create-custom"
                    >
                        <i class="fa fa-floppy-disk me-2"></i>
                        {{ isset($rol) ? 'Guardar cambios' : 'Crear Rol' }}
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush