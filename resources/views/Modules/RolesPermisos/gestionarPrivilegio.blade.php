@extends('layouts.app')

@section('title', 'Gestionar Permisos')

@section('page-title', 'Roles y Permisos')
@section('page-subtitle', 'Administración de privilegios por rol')

@section('content')

<div class="roles-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">

            <div>
                <h5 class="mb-1 fw-bold text-dark">
                    Gestionar Permisos
                </h5>

                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    Configurá los permisos asignados al rol seleccionado
                </p>
            </div>

            <a href="{{ route('roles.index') }}" class="btn-back-link">
                <i class="fa fa-arrow-left me-2"></i>
                Volver al listado
            </a>

        </div>
    </div>

    <form action="{{ route('roles.asignarPermisos', $rol->id) }}" method="POST">
        @csrf

        <div class="row g-4">
            
            <div class="col-12 col-lg-4">
                <div class="card form-card sticky-lg-top" style="top: 20px; z-index: 10;">
                    <div class="card-body px-4 py-4">
                        
                        <div class="form-section-title">
                            <i class="fa fa-info-circle me-2 text-primary"></i>Información del Rol
                        </div>

                        <div class="mb-0">
                            <label class="form-label-custom">
                                Rol Seleccionado
                            </label>

                            <input
                                type="text"
                                class="form-control-custom fw-bold bg-light"
                                value="{{ $rol->nombre }}"
                                readonly
                            >
                            
                            <small class="text-muted d-block mt-2">
                                Los cambios realizados en los permisos se aplicarán inmediatamente a todos los usuarios vinculados a este rol.
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA: SELECCIÓN DE PERMISOS --}}
            <div class="col-12 col-lg-8">
                <div class="card form-card">
                    <div class="card-body px-4 py-4">
                        
                        {{-- ENCABEZADO INTERNO DE PERMISOS --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
                            <div class="form-section-title mb-0 border-bottom-0 pb-0">
                                <i class="fa fa-shield-halved me-2 text-primary"></i>Permisos del Sistema
                            </div>
                            
                            {{-- ACCIONES GLOBALES REUBICADAS --}}
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-perms-global">
                                    <i class="fa fa-check-square me-2 text-success"></i>Seleccionar todo
                                </button>
                                <button type="button" class="btn-perms-global">
                                    <i class="fa fa-square me-2 text-muted"></i>Deseleccionar todo
                                </button>
                            </div>
                        </div>

                        {{-- CUADRÍCULA DE MÓDULOS (2 columnas en escritorio) --}}
                        <div class="row row-cols-1 row-cols-md-2 g-3">

                            @foreach($modulos as $modulo)
                            <div class="col">
                                <div class="perms-module-block h-100">
                                    <div class="perms-module-title">
                                        <i class="fa fa-cube me-2 text-secondary"></i>
                                        {{ $modulo->nombre }}
                                    </div>

                                    <div class="perms-checks">
                                        @foreach($modulo->permisos as $permiso)
                                        <label class="perm-check-label">
                                            <input
                                                type="checkbox"
                                                name="permisos[]"
                                                value="{{ $permiso->id }}"
                                                {{ in_array($permiso->id, $permisosAsignados) ? 'checked' : '' }}
                                            > {{ ucfirst($permiso->accion) }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div> {{-- Fin de la cuadrícula de módulos --}}

                        <hr class="form-divider">

                        {{-- BOTONERA DE ACCIONES --}}
                        <div class="form-actions">
                            <a href="{{ route('roles.index') }}" class="btn-cancel-custom">
                                Cancelar
                            </a>

                            <button type="submit" class="btn-create-custom">
                                <i class="fa fa-floppy-disk me-2"></i>
                                Guardar Permisos
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush