@extends('layouts.app')

@section('title', 'Usuarios')

@section('page-title', 'Usuarios')
@section('page-subtitle', 'Gestión de accesos y privilegios del sistema')

@section('content')

<div class="usuarios-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>Nuevo Usuario
            </a>
        </div>
    </div>

    {{-- ZONA DE MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
             style="border-radius:10px;border:none;background:#d1fae5;color:#065f46;font-size:0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
             style="border-radius:10px;border:none;background:#fee2e2;color:#991b1b;font-size:0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLA PRINCIPAL --}}
    <div class="card table-card"
         style="--table-columns: 1fr 1fr 1.5fr 1fr 1.2fr 0.9fr 1.3fr 1.3fr 0.7fr;">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input
                    type="text"
                    class="search-input"
                    placeholder="Buscar por correo electrónico"
                >
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option value="">Rol</option>
                    <option>Administrador</option>
                    <option>Supervisor</option>
                    <option>Operador</option>
                    <option>Auditor</option>
                </select>

                <select class="filter-select">
                    <option value="">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>

                <select class="filter-select">
                    <option value="">Organización</option>
                    <option>TechCorp</option>
                    <option>DataSoft</option>
                </select>

                <button class="btn-search">Buscar</button>

            </div>

        </div>

        {{-- CABECERA --}}
        <div class="list-header">
            <div>Nombre</div>
            <div>Apellido</div>
            <div>Correo</div>
            <div>Rol</div>
            <div>Organización</div>
            <div class="text-center">Estado</div>
            <div>Empleado Vinc.</div>
            <div>Último Acceso</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- ESTADO SIN DATOS --}}
        {{-- @if($usuarios->isEmpty())
        <div class="empty-state">
            <i class="fa fa-users"></i>
            <p>No existen usuarios registrados.</p>
        </div>
        @else --}}

        {{-- FILA 1 --}}
        <div class="cargo-row">
            <div class="user-name">Juan</div>
            <div class="user-name">Pérez</div>
            <div class="user-email">jperez@empresa.com</div>
            <div>Administrador</div>
            <div>TechCorp</div>
            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>
            <div class="text-truncate" style="max-width:130px;">Juan Pérez</div>
            <div>20/05/2025</div>
            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('usuarios.show', 1) }}" class="dropdown-item">
                                <i class="fa fa-eye me-2"></i>Ver
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.edit', 1) }}" class="dropdown-item">
                                <i class="fa fa-pencil me-2"></i>Editar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item text-warning"
                               data-bs-toggle="modal"
                               data-bs-target="#toggleModal1">
                                <i class="fa fa-ban me-2"></i>Desactivar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.auditoria', 1) }}" class="dropdown-item">
                                <i class="fa fa-clock-rotate-left me-2"></i>Auditoría
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FILA 2 --}}
        <div class="cargo-row">
            <div class="user-name">María</div>
            <div class="user-name">García</div>
            <div class="user-email">mgarcia@empresa.com</div>
            <div>Supervisor</div>
            <div>TechCorp</div>
            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>
            <div class="text-truncate" style="max-width:130px;">María García</div>
            <div>18/05/2025</div>
            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('usuarios.show', 2) }}" class="dropdown-item">
                                <i class="fa fa-eye me-2"></i>Ver
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.edit', 2) }}" class="dropdown-item">
                                <i class="fa fa-pencil me-2"></i>Editar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item text-warning"
                               data-bs-toggle="modal"
                               data-bs-target="#toggleModal2">
                                <i class="fa fa-ban me-2"></i>Desactivar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.auditoria', 2) }}" class="dropdown-item">
                                <i class="fa fa-clock-rotate-left me-2"></i>Auditoría
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FILA 3 --}}
        <div class="cargo-row">
            <div class="user-name">Carlos</div>
            <div class="user-name">López</div>
            <div class="user-email">clopez@empresa.com</div>
            <div>Operador</div>
            <div>DataSoft</div>
            <div class="text-center">
                <span class="status-badge inactive">Inactivo</span>
            </div>
            <div class="user-no-link">Sin vincular</div>
            <div>10/04/2025</div>
            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('usuarios.show', 3) }}" class="dropdown-item">
                                <i class="fa fa-eye me-2"></i>Ver
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.edit', 3) }}" class="dropdown-item">
                                <i class="fa fa-pencil me-2"></i>Editar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item text-success"
                               data-bs-toggle="modal"
                               data-bs-target="#toggleModal3">
                                <i class="fa fa-circle-check me-2"></i>Activar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.auditoria', 3) }}" class="dropdown-item">
                                <i class="fa fa-clock-rotate-left me-2"></i>Auditoría
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FILA 4 --}}
        <div class="cargo-row">
            <div class="user-name">Ana</div>
            <div class="user-name">Martínez</div>
            <div class="user-email">amartinez@empresa.com</div>
            <div>Auditor</div>
            <div>DataSoft</div>
            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>
            <div class="text-truncate" style="max-width:130px;">Ana Martínez</div>
            <div>22/05/2025</div>
            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('usuarios.show', 4) }}" class="dropdown-item">
                                <i class="fa fa-eye me-2"></i>Ver
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.edit', 4) }}" class="dropdown-item">
                                <i class="fa fa-pencil me-2"></i>Editar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item text-warning"
                               data-bs-toggle="modal"
                               data-bs-target="#toggleModal4">
                                <i class="fa fa-ban me-2"></i>Desactivar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.auditoria', 4) }}" class="dropdown-item">
                                <i class="fa fa-clock-rotate-left me-2"></i>Auditoría
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- @endif --}}

        {{-- PAGINACIÓN --}}
        <div class="custom-pagination">
            <button class="page-nav">
                <i class="fa fa-angle-left"></i> Atrás
            </button>
            <div class="page-numbers">
                <button class="page-item active">1</button>
                <button class="page-item">2</button>
                <button class="page-item">3</button>
                <span class="pagination-dots">...</span>
                <button class="page-item">10</button>
            </div>
            <button class="page-nav">
                Siguiente <i class="fa fa-angle-right"></i>
            </button>
        </div>

    </div>

</div>

{{-- MODALES ACTIVAR / DESACTIVAR --}}
@include('Modules.Usuarios.components.modal-toggle', ['id' => 1, 'nombre' => 'Juan Pérez',    'accion' => 'desactivar'])
@include('Modules.Usuarios.components.modal-toggle', ['id' => 2, 'nombre' => 'María García',  'accion' => 'desactivar'])
@include('Modules.Usuarios.components.modal-toggle', ['id' => 3, 'nombre' => 'Carlos López',  'accion' => 'activar'])
@include('Modules.Usuarios.components.modal-toggle', ['id' => 4, 'nombre' => 'Ana Martínez',  'accion' => 'desactivar'])

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
@endpush