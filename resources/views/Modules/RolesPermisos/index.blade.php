@extends('layouts.app')

@section('title', 'Roles y Permisos')

@section('page-title', 'Roles y Permisos')
@section('page-subtitle', 'Gestión de roles y permisos del sistema')

@section('content')

<div class="roles-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1 fw-bold text-dark">Roles del Sistema</h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">Administrá los roles y sus permisos asignados</p>
            </div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>Nuevo Rol
            </a>
        </div>
    </div>

    {{-- ZONA DE MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #d1fae5; color: #065f46; font-size: 0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #fee2e2; color: #991b1b; font-size: 0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning mb-4" style="border-radius: 10px; border: none; background: #fef9c3; color: #854d0e; font-size: 0.9rem;">
            <i class="fa fa-triangle-exclamation me-2"></i>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABLA PRINCIPAL --}}
    <div class="card table-card">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input
                    type="text"
                    class="search-input"
                    placeholder="Buscar rol por nombre"
                >
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option value="">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>

                <button class="btn-search">
                    Buscar
                </button>

                <button class="btn-clear">
                    Limpiar
                </button>

            </div>

        </div>

        {{-- CABECERA --}}
        <div class="roles-list-header">
            <div>Nombre del Rol</div>
            <div>Descripción</div>
            <div class="text-center">Estado</div>
            <div>Fecha de creación</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- ESTADO SIN DATOS --}}
        {{-- @if($roles->isEmpty())
        <div class="empty-state">
            <i class="fa fa-shield-halved"></i>
            <p>No existen roles registrados.</p>
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-new mt-2">
                <i class="fa fa-plus me-2"></i>Crear primer rol
            </a>
        </div>
        @else --}}

        {{-- FILA - Administrador --}}
        <div class="roles-row">
            <div class="role-name">Administrador</div>
            <div class="role-desc">Acceso total al sistema</div>
            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>
            <div>12/01/2025</div>
            <div class="text-end">
                <div class="roles-actions">

                    <a href="{{ route('roles.edit', 1) }}" class="roles-action-btn btn-edit" title="Editar">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </a>

                    <button
                        class="roles-action-btn btn-perms"
                        title="Gestionar Permisos"
                        data-bs-toggle="modal"
                        data-bs-target="#permisosModal"
                        data-rol="Administrador"
                    >
                        <i class="fa fa-lock"></i>
                        Permisos
                    </button>

                    <button
                        class="roles-action-btn btn-delete"
                        title="Eliminar"
                        data-bs-toggle="modal"
                        data-bs-target="#eliminarModal"
                        data-rol="Administrador"
                    >
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </button>

                </div>
            </div>
        </div>

        {{-- FILA - Supervisor --}}
        <div class="roles-row">
            <div class="role-name">Supervisor</div>
            <div class="role-desc">Gestión de equipos y reportes</div>
            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>
            <div>15/01/2025</div>
            <div class="text-end">
                <div class="roles-actions">

                    <a href="{{ route('roles.edit', 2) }}" class="roles-action-btn btn-edit" title="Editar">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </a>

                    <button
                        class="roles-action-btn btn-perms"
                        title="Gestionar Permisos"
                        data-bs-toggle="modal"
                        data-bs-target="#permisosModal"
                        data-rol="Supervisor"
                    >
                        <i class="fa fa-lock"></i>
                        Permisos
                    </button>

                    <button
                        class="roles-action-btn btn-delete"
                        title="Eliminar"
                        data-bs-toggle="modal"
                        data-bs-target="#eliminarModal"
                        data-rol="Supervisor"
                    >
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </button>

                </div>
            </div>
        </div>

        {{-- FILA - Operador --}}
        <div class="roles-row">
            <div class="role-name">Operador</div>
            <div class="role-desc">Carga y consulta de datos operativos</div>
            <div class="text-center">
                <span class="status-badge inactive">Inactivo</span>
            </div>
            <div>20/02/2025</div>
            <div class="text-end">
                <div class="roles-actions">

                    <a href="{{ route('roles.edit', 3) }}" class="roles-action-btn btn-edit" title="Editar">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </a>

                    <button
                        class="roles-action-btn btn-perms"
                        title="Gestionar Permisos"
                        data-bs-toggle="modal"
                        data-bs-target="#permisosModal"
                        data-rol="Operador"
                    >
                        <i class="fa fa-lock"></i>
                        Permisos
                    </button>

                    <button
                        class="roles-action-btn btn-delete"
                        title="Eliminar"
                        data-bs-toggle="modal"
                        data-bs-target="#eliminarModal"
                        data-rol="Operador"
                    >
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </button>

                </div>
            </div>
        </div>

        {{-- FILA - Auditor --}}
        <div class="roles-row">
            <div class="role-name">Auditor</div>
            <div class="role-desc">Solo lectura con acceso a registros de auditoría</div>
            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>
            <div>05/03/2025</div>
            <div class="text-end">
                <div class="roles-actions">

                    <a href="{{ route('roles.edit', 4) }}" class="roles-action-btn btn-edit" title="Editar">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </a>

                    <button
                        class="roles-action-btn btn-perms"
                        title="Gestionar Permisos"
                        data-bs-toggle="modal"
                        data-bs-target="#permisosModal"
                        data-rol="Auditor"
                    >
                        <i class="fa fa-lock"></i>
                        Permisos
                    </button>

                    <button
                        class="roles-action-btn btn-delete"
                        title="Eliminar"
                        data-bs-toggle="modal"
                        data-bs-target="#eliminarModal"
                        data-rol="Auditor"
                    >
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </button>

                </div>
            </div>
        </div>

        {{-- @endif --}}

        {{-- PAGINACIÓN --}}
        <div class="custom-pagination">

            <button class="page-nav">
                <i class="fa fa-angle-left"></i>
                Atrás
            </button>

            <div class="page-numbers">

                <button class="page-item active">1</button>
                <button class="page-item">2</button>
                <button class="page-item">3</button>

                <span class="pagination-dots">...</span>

                <button class="page-item">10</button>

            </div>

            <button class="page-nav">
                Siguiente
                <i class="fa fa-angle-right"></i>
            </button>

        </div>

    </div>

</div>

{{-- =============================================
     MODAL: ASIGNACIÓN DE PERMISOS
     ============================================= --}}
<div class="modal fade" id="permisosModal" tabindex="-1" aria-labelledby="permisosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content custom-modal-content">

            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-1" id="permisosModalLabel">
                        Gestionar Permisos
                    </h5>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                        Rol: <strong id="permisos-rol-nombre">Administrador</strong>
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body px-4 py-3">

                {{-- Controles globales --}}
                <div class="d-flex gap-3 mb-4">
                    <button class="btn-perms-global btn-seleccionar-todo">
                        <i class="fa fa-check-square me-1"></i> Seleccionar todo
                    </button>
                    <button class="btn-perms-global btn-deseleccionar-todo">
                        <i class="fa fa-square me-1"></i> Deseleccionar todo
                    </button>
                </div>

                {{-- Módulo: Usuarios --}}
                <div class="perms-module-block">
                    <div class="perms-module-title">
                        <i class="fa fa-users me-2"></i> Usuarios
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

                {{-- Módulo: Roles --}}
                <div class="perms-module-block">
                    <div class="perms-module-title">
                        <i class="fa fa-shield-halved me-2"></i> Roles y Permisos
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

                {{-- Módulo: Cargos --}}
                <div class="perms-module-block">
                    <div class="perms-module-title">
                        <i class="fa fa-briefcase me-2"></i> Cargos
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

                {{-- Módulo: Reportes --}}
                <div class="perms-module-block">
                    <div class="perms-module-title">
                        <i class="fa fa-chart-bar me-2"></i> Reportes
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

                {{-- Módulo: Configuración --}}
                <div class="perms-module-block">
                    <div class="perms-module-title">
                        <i class="fa fa-gear me-2"></i> Configuración
                    </div>
                    <div class="perms-checks">
                        <label class="perm-check-label">
                            <input type="checkbox"> Ver
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

            <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-end gap-3">
                <button type="button" class="btn-cancel-custom" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-create-custom">Guardar Permisos</button>
            </div>

        </div>
    </div>
</div>

{{-- =============================================
     MODAL: CONFIRMAR ELIMINACIÓN
     ============================================= --}}
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-content">

            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark" id="eliminarModalLabel">Eliminar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body px-4 py-3">

                <div class="delete-confirm-block">
                    <i class="fa fa-triangle-exclamation delete-warn-icon"></i>
                    <p class="mb-1" style="font-size: 0.95rem; color: #334155;">
                        Estás a punto de eliminar el rol:
                    </p>
                    <p class="fw-bold mb-3" style="font-size: 1rem; color: #1e293b;" id="eliminar-rol-nombre">
                        Administrador
                    </p>
                    <p style="font-size: 0.88rem; color: #64748b;">
                        Esta acción no se puede deshacer. Los usuarios con este rol perderán los permisos asociados.
                    </p>
                </div>

            </div>

            <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-end gap-3">
                <button type="button" class="btn-cancel-custom" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-delete-confirm">
                    <i class="fa fa-trash me-2"></i>Eliminar
                </button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush