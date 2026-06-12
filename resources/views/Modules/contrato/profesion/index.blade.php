@extends('layouts.app')

@section('title', 'Profesiones')

@section('page-title', 'Profesiones')
@section('page-subtitle', 'Gestión de profesiones para empleados')

@section('content')

<div class="cargo-page">

    <div class="card top-card mb-4">
        <div class="card-body">

            <button
                class="btn btn-primary btn-new"
                data-bs-toggle="modal"
                data-bs-target="#createProfesionModal">

                <i class="fa fa-plus me-2"></i>
                Nueva Profesión

            </button>

        </div>
    </div>

    <div class="table-card"
         style="--table-columns: 80px 2fr 3fr 120px 100px;">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input
                    type="text"
                    class="search-input"
                    placeholder="Buscar profesión">
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option>Todas</option>
                    <option>Activas</option>
                    <option>Inactivas</option>
                </select>

                <button class="btn-search">
                    Buscar
                </button>

            </div>

        </div>

        {{-- CABECERA --}}
        <div class="list-header profesion-header">

            <div>ID</div>

            <div>Profesión</div>

            <div>Descripción</div>

            <div class="text-center">
                Estado
            </div>

            <div class="text-end">
                Acciones
            </div>

        </div>

        {{-- FILA 1 --}}
        <div class="cargo-row profesion-row">

            <div>001</div>

            <div>
                Ingeniero de Software
            </div>

            <div>
                Desarrollo, mantenimiento y optimización de sistemas informáticos.
            </div>

            <div class="text-center">
                <span class="status-badge active">
                    Activa
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">

                    <button
                        class="action-btn"
                        data-bs-toggle="dropdown">

                        <i class="fa fa-ellipsis-v"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfesionModal">

                                <i class="fa fa-pencil me-2"></i>
                                Editar

                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-warning" href="#">

                                <i class="fa fa-ban me-2"></i>
                                Desactivar

                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        {{-- FILA 2 --}}
        <div class="cargo-row profesion-row">

            <div>002</div>

            <div>
                Contador Público
            </div>

            <div>
                Gestión financiera, contable y tributaria de la organización.
            </div>

            <div class="text-center">
                <span class="status-badge active">
                    Activa
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">

                    <button
                        class="action-btn"
                        data-bs-toggle="dropdown">

                        <i class="fa fa-ellipsis-v"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfesionModal">

                                <i class="fa fa-pencil me-2"></i>
                                Editar

                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-warning" href="#">

                                <i class="fa fa-ban me-2"></i>
                                Desactivar

                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        {{-- FILA 3 --}}
        <div class="cargo-row profesion-row">

            <div>003</div>

            <div>
                Abogado Corporativo
            </div>

            <div>
                Asesoramiento legal y gestión de asuntos jurídicos empresariales.
            </div>

            <div class="text-center">
                <span class="status-badge active">
                    Activa
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">

                    <button
                        class="action-btn"
                        data-bs-toggle="dropdown">

                        <i class="fa fa-ellipsis-v"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfesionModal">

                                <i class="fa fa-pencil me-2"></i>
                                Editar

                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-warning" href="#">

                                <i class="fa fa-ban me-2"></i>
                                Desactivar

                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        {{-- FILA 4 --}}
        <div class="cargo-row profesion-row">

            <div>004</div>

            <div>
                Archivista
            </div>

            <div>
                Organización, clasificación y conservación documental.
            </div>

            <div class="text-center">
                <span class="status-badge inactive">
                    Inactiva
                </span>
            </div>

            <div class="text-end">

                <div class="dropdown">

                    <button
                        class="action-btn"
                        data-bs-toggle="dropdown">

                        <i class="fa fa-ellipsis-v"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfesionModal">

                                <i class="fa fa-pencil me-2"></i>
                                Editar

                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-success" href="#">

                                <i class="fa fa-check me-2"></i>
                                Reactivar

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

@include('Modules.contrato.profesion.components.modal-edit')
@include('Modules.contrato.profesion.components.modal-create')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush