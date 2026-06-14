@extends('layouts.app')

@section('title', isset($cargo) ? 'Editar Cargo' : 'Nuevo Cargo')

@section('page-title', 'Estructura Organizacional')
@section('page-subtitle', isset($cargo) ? 'Modificar datos del cargo existente' : 'Registrar un nuevo cargo en el sistema')

@section('content')

<div class="module-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1 fw-bold text-dark">
                    {{ isset($cargo) ? 'Editar Cargo' : 'Nuevo Cargo' }}
                </h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    {{ isset($cargo) ? 'Modificá los datos del cargo seleccionado' : 'Completá los campos para registrar un nuevo cargo' }}
                </p>
            </div>
            <a href="{{ route('cargos.index') }}" class="btn-back-link">
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
    <div class="card module-card">
        <div class="card-body px-4 py-4">

            <form
                method="POST"
                action="{{ isset($cargo) ? route('cargos.update', $cargo->id) : route('cargos.store') }}"
                id="cargoForm"
            >
                @csrf
                @if(isset($cargo))
                    @method('PUT')
                @endif

                {{-- SECCIÓN: INFORMACIÓN GENERAL --}}
                <div class="form-section-title">Información del Cargo</div>

                <div class="row g-4">

                    {{-- Nombre del Cargo --}}
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label-custom">
                            Nombre del Cargo <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control-custom @error('nombre') is-invalid-custom @enderror"
                            placeholder="Ej: Contador Senior, Desarrollador Backend..."
                            value="{{ old('nombre', $cargo->nombre ?? '') }}"
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
                            <option value="1" {{ old('estado', $cargo->estado ?? '') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $cargo->estado ?? '') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Departamento --}}
                    <div class="col-12 col-md-6">
                        <label for="departamento" class="form-label-custom">
                            Departamento <span class="text-danger">*</span>
                        </label>
                        <select
                            id="departamento"
                            name="departamento"
                            class="form-control-custom form-select-custom @error('departamento') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná un departamento</option>
                            <option value="Tecnología" {{ old('departamento', $cargo->departamento ?? '') == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                            <option value="Finanzas" {{ old('departamento', $cargo->departamento ?? '') == 'Finanzas' ? 'selected' : '' }}>Finanzas</option>
                            <option value="Marketing" {{ old('departamento', $cargo->departamento ?? '') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        </select>
                        @error('departamento')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Superior Inmediato --}}
                    <div class="col-12 col-md-6">
                        <label for="superior" class="form-label-custom">
                            Cargo Superior Jerárquico
                        </label>
                        <select
                            id="superior"
                            name="superior"
                            class="form-control-custom form-select-custom @error('superior') is-invalid-custom @enderror"
                        >
                            <option value="">Ninguno (Reporta directamente a Dirección)</option>
                            <option value="Gerente Financiero" {{ old('superior', $cargo->superior ?? '') == 'Gerente Financiero' ? 'selected' : '' }}>Gerente Financiero</option>
                            <option value="Lead Developer" {{ old('superior', $cargo->superior ?? '') == 'Lead Developer' ? 'selected' : '' }}>Lead Developer</option>
                            <option value="Director Creativo" {{ old('superior', $cargo->superior ?? '') == 'Director Creativo' ? 'selected' : '' }}>Director Creativo</option>
                            <option value="Jefe de TI" {{ old('superior', $cargo->superior ?? '') == 'Jefe de TI' ? 'selected' : '' }}>Jefe de TI</option>
                        </select>
                        @error('superior')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- SEPARADOR --}}
                <hr class="form-divider">

                {{-- BOTONERA --}}
                <div class="form-actions">

                    <a href="{{ route('cargos.index') }}" class="btn-cancel-custom">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-create-custom">
                        <i class="fa fa-floppy-disk me-2"></i>
                        {{ isset($cargo) ? 'Guardar cambios' : 'Crear Cargo' }}
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules_v2.css') }}">
@endpush