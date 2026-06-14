@extends('layouts.app')

@section('title', 'Roles y Permisos')

@section('page-title', 'Roles y Permisos')
@section('page-subtitle', 'Gestión de roles y permisos del sistema')

@section('content')

<div class="roles-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
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
<div class="card table-card" style="--table-columns: 200px 1fr 130px 160px 80px;">

    {{-- FILTROS --}}
    <div class="table-toolbar">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Buscar rol por nombre">
        </div>

        <div class="filter-group">
            <select class="filter-select">
                <option value="">Estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <button class="btn-search">Buscar</button>
        </div>
    </div>

    {{-- CABECERA (Cambiado a list-header para que tome los px) --}}
    <div class="list-header">
        <div>Nombre del Rol</div>
        <div>Descripción</div>
        <div class="text-center">Estado</div>
        <div>Fecha de creación</div>
        <div class="text-end">Acciones</div>
    </div>

    {{-- FILA - Administrador (Cambiado a cargo-row para que tome los px) --}}
    <div class="cargo-row">
        <div class="role-name">Administrador</div>
        <div class="role-desc">Acceso total al sistema</div>
        <div class="text-center">
            <span class="status-badge active">Activo</span>
        </div>
        <div>12/01/2025</div>
        <div class="text-end">
            <div class="dropdown">
                <button class="action-btn" type="button" data-bs-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{ route('roles.edit', 1) }}" class="dropdown-item"><i class="fa fa-pencil me-2"></i>Editar</a></li>
                    <li><a href="{{ route('roles.permissions', 1) }}" class="dropdown-item"><i class="fa fa-lock me-2"></i>Permisos</a></li>
                    <li><a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal1"><i class="fa fa-trash me-2"></i>Eliminar</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- FILA - Supervisor --}}
    <div class="cargo-row">
        <div class="role-name">Supervisor</div>
        <div class="role-desc">Gestión de equipos y reportes</div>
        <div class="text-center">
            <span class="status-badge active">Activo</span>
        </div>
        <div>15/01/2025</div>
        <div class="text-end">
            <div class="dropdown">
                <button class="action-btn" type="button" data-bs-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{ route('roles.edit', 2) }}" class="dropdown-item"><i class="fa fa-pencil me-2"></i>Editar</a></li>
                    <li><a href="{{ route('roles.permissions', 2) }}" class="dropdown-item"><i class="fa fa-lock me-2"></i>Permisos</a></li>
                    <li><a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal2"><i class="fa fa-trash me-2"></i>Eliminar</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- FILA - Operador --}}
    <div class="cargo-row">
        <div class="role-name">Operador</div>
        <div class="role-desc">Carga y consulta de datos operativos</div>
        <div class="text-center">
            <span class="status-badge inactive">Inactivo</span>
        </div>
        <div>20/02/2025</div>
        <div class="text-end">
            <div class="dropdown">
                <button class="action-btn" type="button" data-bs-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{ route('roles.edit', 3) }}" class="dropdown-item"><i class="fa fa-pencil me-2"></i>Editar</a></li>
                    <li><a href="{{ route('roles.permissions', 3) }}" class="dropdown-item"><i class="fa fa-lock me-2"></i>Permisos</a></li>
                    <li><a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal3"><i class="fa fa-trash me-2"></i>Eliminar</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- FILA - Auditor --}}
    <div class="cargo-row">
        <div class="role-name">Auditor</div>
        <div class="role-desc">Solo lectura con acceso a registros de auditoría</div>
        <div class="text-center">
            <span class="status-badge active">Activo</span>
        </div>
        <div>05/03/2025</div>
        <div class="text-end">
            <div class="dropdown">
                <button class="action-btn" type="button" data-bs-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{ route('roles.edit', 4) }}" class="dropdown-item"><i class="fa fa-pencil me-2"></i>Editar</a></li>
                    <li><a href="{{ route('roles.permissions', 4) }}" class="dropdown-item"><i class="fa fa-lock me-2"></i>Permisos</a></li>
                    <li><a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal4"><i class="fa fa-trash me-2"></i>Eliminar</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- PAGINACIÓN --}}
    <div class="custom-pagination">
        <button class="page-nav"><i class="fa fa-angle-left"></i> Atrás</button>
        <div class="page-numbers">
            <button class="page-item active">1</button>
            <button class="page-item">2</button>
            <button class="page-item">3</button>
            <span class="pagination-dots">...</span>
            <button class="page-item">10</button>
        </div>
        <button class="page-nav">Siguiente <i class="fa fa-angle-right"></i></button>
    </div>

</div>

@include('Modules.RolesPermisos.components.modal-eliminar', ['id' => 1, 'nombre' => 'Administrador'])
@include('Modules.RolesPermisos.components.modal-eliminar', ['id' => 2, 'nombre' => 'Supervisor'])
@include('Modules.RolesPermisos.components.modal-eliminar', ['id' => 3, 'nombre' => 'Operador'])
@include('Modules.RolesPermisos.components.modal-eliminar', ['id' => 4, 'nombre' => 'Auditor'])
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush