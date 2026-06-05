@extends('layouts.app')

@section('title', 'Cargo')

@section('page-title', 'Cargos')
@section('page-subtitle', 'Gestión de cargos organizacionales por departamento')

@section('content')

<div class="cargo-page">

    <div class="card top-card mb-4">
        <div class="card-body">
            <button class="btn btn-primary btn-new" data-bs-toggle="modal" data-bs-target="#createCargoModal">
                <i class="fa fa-plus me-2"></i>Nuevo Cargo
            </button>
        </div>
    </div>
    
    <div class="card table-card">

    {{-- FILTROS --}}
    <div class="table-toolbar">

        <div class="search-container">
            <input
                type="text"
                class="search-input"
                placeholder="Buscar cargo por nombre"
            >
        </div>

        <div class="filter-group">

            <select class="filter-select">
                <option>Departamento</option>
                <option>Tecnología</option>
                <option>Finanzas</option>
                <option>Marketing</option>
            </select>

            <select class="filter-select">
                <option>Estado</option>
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
        <div>ID</div>
        <div>Cargo</div>
        <div>Departamento</div>
        <div>Superior</div>
        <div class="text-center">Estado</div>
        <div class="text-end">Acciones</div>
    </div>

    {{-- FILAS --}}
    <div class="cargo-row">
        <div>001</div>
        <div class="cargo-title">Contador Senior</div>
        <div>Finanzas</div>
        <div>Gerente Financiero</div>

        <div class="text-center">
            <span class="status-badge active">
                Activo
            </span>
        </div>

        <div class="text-end">

            <div class="dropdown">
                <button
                    class="action-btn"
                    data-bs-toggle="dropdown"
                >
                    <i class="fa fa-ellipsis-v"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a
                            class="dropdown-item"
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#editCargoModal">
                            <i class="fa fa-pencil me-2"></i>
                            Editar
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            <i class="fa fa-trash me-2"></i>
                            Eliminar
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="cargo-row">
        <div>002</div>
        <div class="cargo-title">Desarrollador Backend</div>
        <div>Tecnología</div>
        <div>Lead Developer</div>

        <div class="text-center">
            <span class="status-badge active">
                Activo
            </span>
        </div>

        <div class="text-end">

            <div class="dropdown">
                <button
                    class="action-btn"
                    data-bs-toggle="dropdown"
                >
                    <i class="fa fa-ellipsis-v"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a
                            class="dropdown-item"
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#editCargoModal">
                            <i class="fa fa-pencil me-2"></i>
                            Editar
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            Eliminar
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="cargo-row">
        <div>003</div>
        <div class="cargo-title">Diseñador UX/UI</div>
        <div>Marketing</div>
        <div>Director Creativo</div>

        <div class="text-center">
            <span class="status-badge inactive">
                Inactivo
            </span>
        </div>

        <div class="text-end">

            <div class="dropdown">
                <button
                    class="action-btn"
                    data-bs-toggle="dropdown"
                >
                    <i class="fa fa-ellipsis-v"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a
                            class="dropdown-item"
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#editCargoModal">
                            <i class="fa fa-pencil me-2"></i>
                            Editar
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            Eliminar
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="cargo-row">
        <div>004</div>
        <div class="cargo-title">Analista de Sistemas</div>
        <div>Tecnología</div>
        <div>Jefe de TI</div>

        <div class="text-center">
            <span class="status-badge active">
                Activo
            </span>
        </div>

        <div class="text-end">

            <div class="dropdown">
                <button
                    class="action-btn"
                    data-bs-toggle="dropdown"
                >
                    <i class="fa fa-ellipsis-v"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#editCargoModal">
                    <i class="fa fa-pencil me-2"></i>
                    Editar
                </a>
    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            Eliminar
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- PAGINACIÓN --}}
    <div class="custom-pagination">

        <button class="page-nav">
            <i class="fa fa-angle-left"></i>
            Atrás
        </button>

        <div class="page-numbers">

            <button class="page-item active">
                1
            </button>

            <button class="page-item">
                2
            </button>

            <button class="page-item">
                3
            </button>

            <span class="pagination-dots">
                ...
            </span>

            <button class="page-item">
                10
            </button>

        </div>

        <button class="page-nav">
            Siguiente
            <i class="fa fa-angle-right"></i>
        </button>

    </div>

</div>

</div>
</div>
@include('Modules.cargo.components.modal-edit')
@include('Modules.cargo.components.modal-create')
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush