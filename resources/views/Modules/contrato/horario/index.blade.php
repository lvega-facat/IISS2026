@extends('layouts.app')

@section('title', 'Horarios Laborales')

@section('page-title', 'Horarios Laborales')
@section('page-subtitle', 'Configuración de jornadas y horarios de trabajo')

@section('content')

<div class="cargo-page">

    <div class="card top-card mb-4">
        <div class="card-body">

            <button
                class="btn btn-primary btn-new"
                data-bs-toggle="modal"
                data-bs-target="#createHorarioModal">

                <i class="fa fa-plus me-2"></i>
                Nuevo Horario

            </button>

        </div>
    </div>

    <div class="table-card"
         style="--table-columns: 80px 1.8fr 1.4fr 1.6fr 120px 120px 100px;">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input
                    type="text"
                    class="search-input"
                    placeholder="Buscar horario">
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option>Tipo de Jornada</option>
                    <option>Jornada Completa</option>
                    <option>Media Jornada</option>
                    <option>Jornalero</option>
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
        <div class="list-header horario-header">

            <div>ID</div>

            <div>Horario</div>

            <div>Tipo Jornada</div>

            <div>Entrada / Salida</div>

            <div class="text-center">
                Tolerancia
            </div>

            <div class="text-center">
                Estado
            </div>

            <div class="text-end">
                Acciones
            </div>

        </div>

        {{-- FILA 1 --}}
        <div class="cargo-row horario-row">

            <div>001</div>

            <div>
                Administrativo
            </div>

            <div>
                Jornada Completa
            </div>

            <div>
                08:00 - 17:00
            </div>

            <div class="text-center">
                10 min
            </div>

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
                                data-bs-target="#editHorarioModal">

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
        <div class="cargo-row horario-row">

            <div>002</div>

            <div>
                Atención al Cliente
            </div>

            <div>
                Media Jornada
            </div>

            <div>
                08:00 - 12:00
            </div>

            <div class="text-center">
                5 min
            </div>

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
                                data-bs-target="#editHorarioModal">

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
        <div class="cargo-row horario-row">

            <div>003</div>

            <div>
                Operario de Planta
            </div>

            <div>
                Jornalero
            </div>

            <div>
                07:00 - 15:00
            </div>

            <div class="text-center">
                15 min
            </div>

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
                                data-bs-target="#editHorarioModal">

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
        <div class="cargo-row horario-row">

            <div>004</div>

            <div>
                Turno Nocturno
            </div>

            <div>
                Jornada Completa
            </div>

            <div>
                22:00 - 06:00
            </div>

            <div class="text-center">
                10 min
            </div>

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
                                data-bs-target="#editHorarioModal">

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

@include('Modules.contrato.horario.components.modal-edit')
@include('Modules.contrato.horario.components.modal-create')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush