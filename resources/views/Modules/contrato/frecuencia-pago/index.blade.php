@extends('layouts.app')

@section('title', 'Frecuencias de Pago')

@section('page-title', 'Frecuencias de Pago')
@section('page-subtitle', 'Gestión de frecuencias de pago utilizadas por la organización')

@section('content')

<div class="cargo-page">

<div class="card top-card mb-4">
    <div class="card-body">

        <button
            class="btn btn-primary btn-new"
            data-bs-toggle="modal"
            data-bs-target="#createFrecuenciaPagoModal">

            <i class="fa fa-plus me-2"></i>
            Nueva Frecuencia de Pago

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
                placeholder="Buscar frecuencia de pago">
        </div>

        <div class="filter-group">

            <select class="filter-select">
                <option>Todos</option>
                <option>Activos</option>
                <option>Inactivos</option>
            </select>

            <button class="btn-search">
                Buscar
            </button>

        </div>

    </div>

    {{-- CABECERA --}}
    <div class="list-header frecuencia-header">

        <div>ID</div>

        <div>Frecuencia de Pago</div>

        <div>Descripción</div>

        <div class="text-center">
            Estado
        </div>

        <div class="text-end">
            Acciones
        </div>

    </div>

    {{-- FILA 1 --}}
    <div class="cargo-row frecuencia-row">

        <div>001</div>

        <div>
            Mensual
        </div>

        <div>
            Pago realizado una vez por mes.
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
                            data-bs-target="#editFrecuenciaPagoModal">

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
    <div class="cargo-row frecuencia-row">

        <div>002</div>

        <div>
            Quincenal
        </div>

        <div>
            Pago realizado cada quince días.
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
                            data-bs-target="#editFrecuenciaPagoModal">

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
    <div class="cargo-row frecuencia-row">

        <div>003</div>

        <div>
            Semanal
        </div>

        <div>
            Pago realizado una vez por semana.
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
                            data-bs-target="#editFrecuenciaPagoModal">

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
    <div class="cargo-row frecuencia-row">

        <div>004</div>

        <div>
            Diario
        </div>

        <div>
            Pago realizado diariamente.
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
                            data-bs-target="#editFrecuenciaPagoModal">

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

            <button class="page-item active">1</button>
            <button class="page-item">2</button>
            <button class="page-item">3</button>

            <span class="pagination-dots">
                ...
            </span>

            <button class="page-item">10</button>

        </div>

        <button class="page-nav">
            Siguiente
            <i class="fa fa-angle-right"></i>
        </button>

    </div>

</div>
```

</div>

@include('Modules.contrato.frecuencia-pago.components.modal-edit')
@include('Modules.contrato.frecuencia-pago.components.modal-create')

@endsection

@push('styles')

<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush
