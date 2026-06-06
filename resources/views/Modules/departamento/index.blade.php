@extends('layouts.app')

@section('title', 'Departamentos')

@section('page-title', 'Departamentos')
@section('page-subtitle', 'Gestión de departamentos organizacionales')

@section('content')

<div class="cargo-page">

    {{-- BOTÓN NUEVO --}}
    <div class="card top-card mb-4">
        <div class="card-body">
            <button class="btn btn-primary btn-new"
                data-bs-toggle="modal"
                data-bs-target="#createDepartamentoModal">
                <i class="fa fa-plus me-2"></i>Nuevo Departamento
            </button>
        </div>
    </div>

    <div class="card table-card">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Buscar departamento">
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option>Estado</option>
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>

                <button class="btn-search">Buscar</button>

            </div>

        </div>

        {{-- CABECERA --}}
        <div class="list-header">
            <div>Nombre</div>
            <div>Departamento padre</div>
            <div class="text-center">Empleados</div>
            <div class="text-center">Estado</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- FILA 1 --}}
        <div class="cargo-row">
            <div class="cargo-title">Administración</div>
            <div>-</div>

            <div class="text-center">12</div>

            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>

            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"
                               data-bs-toggle="modal"
                               data-bs-target="#editDepartamentoModal">
                                Editar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger">
                                Eliminar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FILA 2 --}}
        <div class="cargo-row">
            <div>Recursos Humanos</div>
            <div>Administración</div>

            <div class="text-center">5</div>

            <div class="text-center">
                <span class="status-badge active">Activo</span>
            </div>

            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item">Editar</a></li>
                        <li><a class="dropdown-item text-danger">Eliminar</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FILA 3 --}}
        <div class="cargo-row">
            <div>Tecnología</div>
            <div>-</div>

            <div class="text-center">20</div>

            <div class="text-center">
                <span class="status-badge inactive">Inactivo</span>
            </div>

            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item">Editar</a></li>
                        <li><a class="dropdown-item text-danger">Eliminar</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="custom-pagination">
            <button class="page-nav">Atrás</button>

            <div class="page-numbers">
                <button class="page-item active">1</button>
                <button class="page-item">2</button>
            </div>

            <button class="page-nav">Siguiente</button>
        </div>

    </div>
</div>

{{-- MODALES --}}
@include('Modules.departamento.components.modal-create')
@include('Modules.departamento.components.modal-edit')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush