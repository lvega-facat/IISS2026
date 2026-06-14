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
                                        <a class="dropdown-item text-danger" href="#">
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
                                        <a class="dropdown-item text-danger" href="#">
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
                                        <a class="dropdown-item text-danger" href="#">
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
                                        <a class="dropdown-item text-danger" href="#">
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

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules_v2.css') }}">
@endpush