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

    <form action="#" method="POST">
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
                                value="Administrador"
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

                            {{-- MÓDULO: USUARIOS --}}
                            <div class="col">
                                <div class="perms-module-block h-100">
                                    <div class="perms-module-title">
                                        <i class="fa fa-users me-2 text-secondary"></i>
                                        Usuarios
                                    </div>

                                    <div class="perms-checks">
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Ver
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Crear
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Editar
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Eliminar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- MÓDULO: ROLES --}}
                            <div class="col">
                                <div class="perms-module-block h-100">
                                    <div class="perms-module-title">
                                        <i class="fa fa-shield-halved me-2 text-secondary"></i>
                                        Roles y Permisos
                                    </div>

                                    <div class="perms-checks">
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Ver
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Crear
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Editar
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Eliminar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- MÓDULO: CARGOS --}}
                            <div class="col">
                                <div class="perms-module-block h-100">
                                    <div class="perms-module-title">
                                        <i class="fa fa-briefcase me-2 text-secondary"></i>
                                        Cargos
                                    </div>

                                    <div class="perms-checks">
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Ver
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Crear
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Editar
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Eliminar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- MÓDULO: REPORTES --}}
                            <div class="col">
                                <div class="perms-module-block h-100">
                                    <div class="perms-module-title">
                                        <i class="fa fa-chart-bar me-2 text-secondary"></i>
                                        Reportes
                                    </div>

                                    <div class="perms-checks">
                                        <label class="perm-check-label">
                                            <input type="checkbox" checked> Ver
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Crear
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Editar
                                        </label>
                                        <label class="perm-check-label">
                                            <input type="checkbox"> Eliminar
                                        </label>
                                    </div>
                                </div>
                            </div>

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