@extends('layouts.app')

@section('title', 'Departamentos')

@section('page-title', 'Departamentos')
@section('page-subtitle', 'Gestión de departamentos organizacionales')

@section('content')

<div class="cargo-page">

    {{-- BOTÓN NUEVO --}}
    <div class="card top-card mb-4">
        <div class="card-body">

            <button class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>
                Nuevo Departamento
            </button>

        </div>
    </div>

    <div class="card table-card">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input type="text"
                       class="search-input"
                       placeholder="Buscar por nombre">
            </div>

            <div class="search-container">
                <input type="text"
                       class="search-input"
                       placeholder="Buscar por código">
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option>Todos</option>
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>

                <button class="btn-search">
                    Buscar
                </button>

            </div>

        </div>

        {{-- CABECERA --}}
        <div class="list-header">
            <div>Nombre</div>
            <div>Código</div>
            <div>Función Principal</div>
            <div>Departamento Padre</div>
            <div class="text-center">Empleados Activos</div>
            <div class="text-center">Estado</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- FILA 1 --}}
        <div class="cargo-row">

            <div class="cargo-title">
                Administración
            </div>

            <div>
                ADM001
            </div>

            <div>
                Gestión administrativa
            </div>

            <div>
                Ninguno
            </div>

            <div class="text-center">
                15
            </div>

            <div class="text-center">
                <span class="status-badge active">
                    Activo
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item">
                                Editar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item">
                                Desactivar
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        {{-- FILA 2 --}}
        <div class="cargo-row">

            <div class="cargo-title">
                Recursos Humanos
            </div>

            <div>
                RRHH001
            </div>

            <div>
                Gestión del personal
            </div>

            <div>
                Administración
            </div>

            <div class="text-center">
                8
            </div>

            <div class="text-center">
                <span class="status-badge active">
                    Activo
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item">
                                Editar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item">
                                Desactivar
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        {{-- FILA 3 --}}
        <div class="cargo-row">

            <div class="cargo-title">
                Tecnología
            </div>

            <div>
                TEC001
            </div>

            <div>
                Desarrollo y soporte tecnológico
            </div>

            <div>
                Ninguno
            </div>

            <div class="text-center">
                20
            </div>

            <div class="text-center">
                <span class="status-badge inactive">
                    Inactivo
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item">
                                Editar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item">
                                Activar
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        {{-- PAGINACIÓN MOCKUP --}}
        <div class="custom-pagination">

            <button class="page-nav">
                Atrás
            </button>

            <div class="page-numbers">
                <button class="page-item active">1</button>
                <button class="page-item">2</button>
                <button class="page-item">3</button>
            </div>

            <button class="page-nav">
                Siguiente
            </button>

        </div>

    </div>

</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush