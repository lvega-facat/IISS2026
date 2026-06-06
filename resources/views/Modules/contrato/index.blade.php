@extends('layouts.app')

@section('title', 'Tipos de Contrato')

@section('page-title', 'Tipos de Contrato')
@section('page-subtitle', 'Gestión de contratos laborales y configuraciones asociadas')

@section('content')

<div class="cargo-page">

    <div class="card top-card mb-4">
        <div class="card-body">
            <button
                class="btn btn-primary btn-new"
                data-bs-toggle="modal"
                data-bs-target="#createContratoModal">
                <i class="fa fa-plus me-2"></i>
                Nuevo Tipo de Contrato
            </button>
        </div>
    </div>

    <div class="table-card"
     style="--table-columns: 80px 2fr 1.5fr 1.8fr 1.6fr 120px 100px;">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input
                    type="text"
                    class="search-input"
                    placeholder="Buscar tipo de contrato">
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option>Profesión</option>
                    <option>Ingeniero</option>
                    <option>Contador</option>
                    <option>Abogado</option>
                    <option>Administrador</option>
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
        <div class="list-header contrato-header">
            <div>ID</div>
            <div>Contrato</div>
            <div>Profesión</div>
            <div>Horario Laboral</div>
            <div>Tipo/Frecuencia Pago</div>
            <div class="text-center">Estado</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- FILA 1 --}}
        <div class="cargo-row contrato-row">

            <div>001</div>
            <div>Contrato Permanente</div>
            <div>Ingeniero</div>
            <div>Lunes a Viernes</div>
            <div>Mensual</div>

            <div class="text-center">
                <span class="status-badge active">
                    Activo
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
                                data-bs-target="#editContratoModal">
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

        {{-- FILA 2 --}}
        <div class="cargo-row contrato-row">

            <div>002</div>
            <div>Contrato Temporal</div>
            <div>Contador</div>
            <div>Medio Tiempo</div>
            <div>Quincenal</div>

            <div class="text-center">
                <span class="status-badge active">
                    Activo
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
                                data-bs-target="#editContratoModal">
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

        {{-- FILA 3 --}}
        <div class="cargo-row contrato-row">

            <div>003</div>
            <div>Contrato por Proyecto</div>
            <div>Abogado</div>
            <div>Horario Flexible</div>
            <div>Mensual</div>

            <div class="text-center">
                <span class="status-badge inactive">
                    Inactivo
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
                                data-bs-target="#editContratoModal">
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

        {{-- FILA 4 --}}
        <div class="cargo-row contrato-row">

            <div>004</div>
            <div>Contrato de Pasantía</div>
            <div>Administrador</div>
            <div>4 Horas Diarias</div>
            <div>Mensual</div>

            <div class="text-center">
                <span class="status-badge active">
                    Activo
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
                                data-bs-target="#editContratoModal">
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

@include('Modules.contrato.components.modal-edit')
@include('Modules.contrato.components.modal-create')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush