@extends('layouts.app')

@section('title', 'Tipos de Contrato')

@section('page-title', 'Tipos de Contrato')
@section('page-subtitle', 'Gestión y administración de condiciones y configuraciones contractuales laborales')

@section('content')

<div class="module-page">

    <div class="card top-card mb-4">
        <div class="card-body">
            <a href="{{ route('tipos-contrato.create') }}" class="btn btn-primary btn-new" style="text-decoration: none; display: inline-flex; align-items: center;">
                <i class="fa fa-plus me-2"></i>Nuevo Tipo de Contrato
            </a>
        </div>
    </div>
    
    {{-- ALERTAS DE ERROR DE VALIDACIÓN / AUDITORÍA (Ej: Rechazo por empleados vinculados) --}}
    @if($errors->any() || session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #fee2e2; color: #991b1b; font-size: 0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>
            {{ session('error') ?? $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERTAS DE ÉXITO --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #d1fae5; color: #065f46; font-size: 0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="module-card">

        {{-- FILTROS CONFORME A LAS ENTIDADES ASOCIADAS EN LA HU --}}
        <div class="module-toolbar">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Buscar contrato por nombre">
            </div>

            <div class="filter-group">
                <select class="filter-select">
                    <option>Profesión</option>
                    <option>Desarrollador Backend</option>
                    <option>Contador Senior</option>
                    <option>Diseñador UX/UI</option>
                </select>

                <select class="filter-select">
                    <option>Frecuencia de Pago</option>
                    <option>Mensual</option>
                    <option>Quincenal</option>
                    <option>Semanal</option>
                </select>

                <button class="btn-search">Buscar</button>
            </div>
        </div>

        {{-- TABLA UNIVERSAL ADAPTADA A LAS CONFIGURACIONES ASOCIADAS DE LA HU --}}
        <div class="table-responsive">
            <table class="module-table">
                <thead>
                    <tr>
                        <th class="nowrap">ID</th>
                        <th>Tipo de Contrato</th>
                        <th>Profesión Asociada</th>
                        <th>Horario Laboral</th>
                        <th>Tipo / Frecuencia Pago</th>
                        <th class="text-center nowrap">Estado</th>
                        <th class="text-end nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Fila 1 --}}
                    <tr>
                        <td class="nowrap">001</td>
                        <td class="module-title-cell">
                            <strong>Plante Permanente Completo</strong>
                            <div class="text-muted" style="font-size: 0.78rem; font-weight: normal;">Contratación por tiempo indefinido con prestaciones completas.</div>
                        </td>
                        <td>Contador Senior</td>
                        <td>Lun a Vie 08:00 - 17:00</td>
                        <td>Transferencia / Mensual</td>
                        <td class="text-center nowrap">
                            <span class="status-badge active">Activo</span>
                        </td>
                        <td class="text-end nowrap">
                            <div class="dropdown">
                                <button class="action-btn" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('tipos-contrato.edit', 1) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal1">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{-- RUTA DE MODAL CORREGIDA CON EL PATH ABSOLUTO DEL MÓDULO --}}
                    @include('Modules.Contratos.TiposContrato.components.modal-eliminar', ['id' => 1, 'nombre' => 'Plante Permanente Completo'])

                    {{-- Fila 2 --}}
                    <tr>
                        <td class="nowrap">002</td>
                        <td class="module-title-cell">
                            <strong>Prestación de Servicios TI</strong>
                            <div class="text-muted" style="font-size: 0.78rem; font-weight: normal;">Contrato temporal sujeto al cumplimiento de objetivos del proyecto.</div>
                        </td>
                        <td>Desarrollador Backend</td>
                        <td>Flexible / Remoto (40h)</td>
                        <td>Honorarios / Quincenal</td>
                        <td class="text-center nowrap">
                            <span class="status-badge active">Activo</span>
                        </td>
                        <td class="text-end nowrap">
                            <div class="dropdown">
                                <button class="action-btn" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('tipos-contrato.edit', 2) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal2">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{-- RUTA DE MODAL CORREGIDA CON EL PATH ABSOLUTO DEL MÓDULO --}}
                    @include('Modules.Contratos.TiposContrato.components.modal-eliminar', ['id' => 2, 'nombre' => 'Prestación de Servicios TI'])

                    {{-- Fila 3 --}}
                    <tr>
                        <td class="nowrap">003</td>
                        <td class="module-title-cell">
                            <strong>Pasantía Universitaria</strong>
                            <div class="text-muted" style="font-size: 0.78rem; font-weight: normal;">Convenio de entrenamiento profesional por periodo de 6 meses.</div>
                        </td>
                        <td>Diseñador UX/UI</td>
                        <td>Lun a Vie 08:00 - 12:00</td>
                        <td>Estipendio / Mensual</td>
                        <td class="text-center nowrap">
                            <span class="status-badge inactive">Inactivo</span>
                        </td>
                        <td class="text-end nowrap">
                            <div class="dropdown">
                                <button class="action-btn" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('tipos-contrato.edit', 3) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal3">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{-- RUTA DE MODAL CORREGIDA CON EL PATH ABSOLUTO DEL MÓDULO --}}
                    @include('Modules.Contratos.TiposContrato.components.modal-eliminar', ['id' => 3, 'nombre' => 'Pasantía Universitaria'])

                </tbody>
            </table>
        </div>

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

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules_v2.css') }}">
@endpush