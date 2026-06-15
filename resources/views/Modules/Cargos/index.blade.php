@extends('layouts.app')

@section('title', 'Cargo')

@section('page-title', 'Cargos')
@section('page-subtitle', 'Gestión de cargos organizacionales por departamento')

@section('content')

<div class="module-page">

    <div class="card top-card mb-4">
        <div class="card-body">
            <a href="{{ route('cargos.create') }}" class="btn btn-primary btn-new" style="text-decoration: none; display: inline-flex; align-items: center;">
                <i class="fa fa-plus me-2"></i>Nuevo Cargo
            </a>
        </div>
    </div>
    
    <div class="module-card">

        {{-- FILTROS --}}
        <div class="module-toolbar">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Buscar cargo por nombre">
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

                <button class="btn-search">Buscar</button>
            </div>
        </div>

        {{-- TABLA UNIVERSAL CON SCROLL RESPONSIVO --}}
        <div class="table-responsive">
            <table class="module-table">
                <thead>
                    <tr>
                        <th class="nowrap">ID</th>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Superior</th>
                        <th class="text-center nowrap">Estado</th>
                        <th class="text-end nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Fila 1 --}}
                    <tr>
                        <td class="nowrap">001</td>
                        <td class="module-title-cell">Contador Senior</td>
                        <td>Finanzas</td>
                        <td>Gerente Financiero</td>
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
                                        <a class="dropdown-item" href="{{ route('cargos.edit', 1) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        {{-- VINCULADO AL MODAL 1 --}}
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal1">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 2 --}}
                    <tr>
                        <td class="nowrap">002</td>
                        <td class="module-title-cell">Desarrollador Backend</td>
                        <td>Tecnología</td>
                        <td>Lead Developer</td>
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
                                        <a class="dropdown-item" href="{{ route('cargos.edit', 2) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        {{-- VINCULADO AL MODAL 2 --}}
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal2">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 3 --}}
                    <tr>
                        <td class="nowrap">003</td>
                        <td class="module-title-cell">Diseñador UX/UI</td>
                        <td>Marketing</td>
                        <td>Director Creativo</td>
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
                                        <a class="dropdown-item" href="{{ route('cargos.edit', 3) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        {{-- VINCULADO AL MODAL 3 --}}
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal3">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 4 --}}
                    <tr>
                        <td class="nowrap">004</td>
                        <td class="module-title-cell">Analista de Sistemas</td>
                        <td>Tecnología</td>
                        <td>Jefe de TI</td>
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
                                        <a class="dropdown-item" href="{{ route('cargos.edit', 4) }}">
                                            <i class="fa fa-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        {{-- VINCULADO AL MODAL 4 --}}
                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal4">
                                            <i class="fa fa-trash me-2"></i> Eliminar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
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

{{-- ==========================================================================
   CONJUNTO DE MODALES DE ELIMINACIÓN (ESTILO MODERNO MODULES_V2.CSS)
   ========================================================================== --}}

{{-- Modal para Fila 1 --}}
<div class="modal fade" id="eliminarModal1" tabindex="-1" aria-labelledby="eliminarModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-content">
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark" id="eliminarModalLabel1">Eliminar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('cargos.destroy', 1) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body px-4 py-3">
                    <div class="text-center">
                        <i class="fa fa-triangle-exclamation mb-3" style="font-size: 3rem; color: #bd0909;"></i>
                        <p class="mb-2" style="font-size: 0.95rem; color: #475569;">Estás a punto de eliminar el cargo:</p>
                        <p class="fw-bold mb-3" style="font-size: 1.1rem; color: #1e293b;">Contador Senior</p>
                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción no se puede deshacer.<br>
                            Los empleados asociados podrían quedar sin un cargo asignado en el sistema.
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-center gap-3">
                    <button type="button" class="btn-cancel-custom" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-cancel-custom" style="background-color: #a30808 !important;">
                        <i class="fa fa-trash me-2"></i>Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal para Fila 2 --}}
<div class="modal fade" id="eliminarModal2" tabindex="-1" aria-labelledby="eliminarModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-content">
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark" id="eliminarModalLabel2">Eliminar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('cargos.destroy', 2) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body px-4 py-3">
                    <div class="text-center">
                        <i class="fa fa-triangle-exclamation mb-3" style="font-size: 3rem; color: #bd0909;"></i>
                        <p class="mb-2" style="font-size: 0.95rem; color: #475569;">Estás a punto de eliminar el cargo:</p>
                        <p class="fw-bold mb-3" style="font-size: 1.1rem; color: #1e293b;">Desarrollador Backend</p>
                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción no se puede deshacer.<br>
                            Los empleados asociados podrían quedar sin un cargo asignado en el sistema.
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-center gap-3">
                    <button type="button" class="btn-cancel-custom" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-cancel-custom" style="background-color: #a30808 !important;">
                        <i class="fa fa-trash me-2"></i>Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal para Fila 3 --}}
<div class="modal fade" id="eliminarModal3" tabindex="-1" aria-labelledby="eliminarModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-content">
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark" id="eliminarModalLabel3">Eliminar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('cargos.destroy', 3) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body px-4 py-3">
                    <div class="text-center">
                        <i class="fa fa-triangle-exclamation mb-3" style="font-size: 3rem; color: #bd0909;"></i>
                        <p class="mb-2" style="font-size: 0.95rem; color: #475569;">Estás a punto de eliminar el cargo:</p>
                        <p class="fw-bold mb-3" style="font-size: 1.1rem; color: #1e293b;">Diseñador UX/UI</p>
                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción no se puede deshacer.<br>
                            Los empleados asociados podrían quedar sin un cargo asignado en el sistema.
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-center gap-3">
                    <button type="button" class="btn-cancel-custom" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-cancel-custom" style="background-color: #a30808 !important;">
                        <i class="fa fa-trash me-2"></i>Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal para Fila 4 --}}
<div class="modal fade" id="eliminarModal4" tabindex="-1" aria-labelledby="eliminarModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-content">
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark" id="eliminarModalLabel4">Eliminar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('cargos.destroy', 4) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body px-4 py-3">
                    <div class="text-center">
                        <i class="fa fa-triangle-exclamation mb-3" style="font-size: 3rem; color: #bd0909;"></i>
                        <p class="mb-2" style="font-size: 0.95rem; color: #475569;">Estás a punto de eliminar el cargo:</p>
                        <p class="fw-bold mb-3" style="font-size: 1.1rem; color: #1e293b;">Analista de Sistemas</p>
                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción no se puede deshacer.<br>
                            Los empleados asociados podrían quedar sin un cargo asignado en el sistema.
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-center gap-3">
                    <button type="button" class="btn-cancel-custom" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-cancel-custom" style="background-color: #a30808 !important;">
                        <i class="fa fa-trash me-2"></i>Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules_v2.css') }}">
@endpush