@extends('layouts.app')

@section('title', 'Empleados')

@section('page-title', 'Empleados')
@section('page-subtitle', 'Gestión del personal de la empresa')

@section('content')

<div class="roles-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            @can('empleados.crear')
            <a href="{{ route('empleados.create') }}" class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>Nuevo Empleado
            </a>
            @endcan
        </div>
    </div>

    {{-- ZONA DE MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #d1fae5; color: #065f46; font-size: 0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px; border: none; background: #fee2e2; color: #991b1b; font-size: 0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning mb-4" style="border-radius: 10px; border: none; background: #fef9c3; color: #854d0e; font-size: 0.9rem;">
            <i class="fa fa-triangle-exclamation me-2"></i>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABLA PRINCIPAL --}}
    <div class="card table-card" style="--table-columns: 180px 160px 160px 130px 120px 80px;">

        {{-- FILTROS --}}
        <form method="GET" action="{{ route('empleados.index') }}">
            <div class="table-toolbar">
                <div class="search-container">
                    <input type="text" name="busqueda" class="search-input"
                           placeholder="Buscar por nombre, apellido o CI/DNI"
                           value="{{ request('busqueda') }}">
                </div>

                <div class="filter-group">
                    <select name="id_departamento" class="filter-select">
                        <option value="">Departamento</option>
                        @foreach($departamentos as $dep)
                            <option value="{{ $dep->id }}" {{ request('id_departamento') == $dep->id ? 'selected' : '' }}>
                                {{ $dep->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <select name="id_cargo" class="filter-select">
                        <option value="">Cargo</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ request('id_cargo') == $cargo->id ? 'selected' : '' }}>
                                {{ $cargo->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <select name="tipo_trabajo" class="filter-select">
                        <option value="">Tipo de trabajo</option>
                        <option value="Presencial" {{ request('tipo_trabajo') === 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Remoto"     {{ request('tipo_trabajo') === 'Remoto'     ? 'selected' : '' }}>Remoto</option>
                        <option value="Híbrido"    {{ request('tipo_trabajo') === 'Híbrido'    ? 'selected' : '' }}>Híbrido</option>
                    </select>

                    <select name="estado" class="filter-select">
                        <option value="">Estado</option>
                        <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>

                    <button type="submit" class="btn-search">Buscar</button>

                    @if(request()->hasAny(['busqueda','id_departamento','id_cargo','tipo_trabajo','estado']))
                        <a href="{{ route('empleados.index') }}" class="btn-search" style="background:#6b7280;">Limpiar</a>
                    @endif
                </div>
            </div>
        </form>

        {{-- CABECERA --}}
        <div class="list-header">
            <div>Empleado</div>
            <div>Departamento</div>
            <div>Cargo</div>
            <div>Tipo de trabajo</div>
            <div class="text-center">Estado</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- FILAS --}}
        @forelse($empleados as $empleado)
        <div class="cargo-row">
            <div>
                <div class="role-name">{{ $empleado->apellido }}, {{ $empleado->nombre }}</div>
                <small class="text-muted">{{ $empleado->dni_ci }}</small>
            </div>
            <div>{{ $empleado->departamentos->nombre ?? '—' }}</div>
            <div>{{ $empleado->cargos->nombre ?? '—' }}</div>
            <div>{{ $empleado->tipo_trabajo ?? '—' }}</div>
            <div class="text-center">
                @if($empleado->deleted_at)
                    <span class="status-badge inactive">Baja</span>
                @elseif($empleado->estado)
                    <span class="status-badge active">Activo</span>
                @else
                    <span class="status-badge inactive">Inactivo</span>
                @endif
            </div>
            <div class="text-end">
                <div class="dropdown">
                    <button class="action-btn" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('empleados.show', $empleado->id) }}" class="dropdown-item">
                                <i class="fa fa-eye me-2"></i>Ver ficha
                            </a>
                        </li>
                        @can('empleados.editar')
                        <li>
                            <a href="{{ route('empleados.edit', $empleado->id) }}" class="dropdown-item">
                                <i class="fa fa-pencil me-2"></i>Editar
                            </a>
                        </li>
                        @endcan
                        @can('empleados.ver')
                        <li>
                            <a href="{{ route('empleados.exportar.pdf', $empleado->id) }}" class="dropdown-item">
                                <i class="fa fa-file-pdf me-2"></i>Exportar PDF
                            </a>
                        </li>
                        @endcan
                        @can('empleados.baja')
                        @if(!$empleado->deleted_at)
                        <li>
                            <a href="#" class="dropdown-item text-danger"
                               data-bs-toggle="modal"
                               data-bs-target="#eliminarModal{{ $empleado->id }}">
                                <i class="fa fa-user-slash me-2"></i>Dar de baja
                            </a>
                        </li>
                        @endif
                        @endcan
                        @can('empleados.restaurar')
                        @if($empleado->deleted_at)
                        <li>
                            <form method="POST" action="{{ route('empleados.restore', $empleado->id) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="dropdown-item text-success">
                                    <i class="fa fa-rotate-left me-2"></i>Restaurar
                                </button>
                            </form>
                        </li>
                        @endif
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <div class="cargo-row">
            <div colspan="6" class="text-center text-muted py-4" style="grid-column: 1 / -1;">
                <i class="fa fa-users fa-2x mb-2 d-block"></i>
                No se encontraron empleados con los filtros aplicados.
            </div>
        </div>
        @endforelse

        {{-- PAGINACIÓN --}}
        @if($empleados->hasPages())
        <div class="custom-pagination">
            <button class="page-nav" {{ $empleados->onFirstPage() ? 'disabled' : '' }}
                    onclick="window.location='{{ $empleados->previousPageUrl() }}'">
                <i class="fa fa-angle-left"></i> Atrás
            </button>
            <div class="page-numbers">
                @foreach($empleados->getUrlRange(1, $empleados->lastPage()) as $page => $url)
                    @if(abs($page - $empleados->currentPage()) <= 2 || $page === 1 || $page === $empleados->lastPage())
                        <button class="page-item {{ $page == $empleados->currentPage() ? 'active' : '' }}"
                                onclick="window.location='{{ $url }}'">{{ $page }}</button>
                    @elseif(abs($page - $empleados->currentPage()) === 3)
                        <span class="pagination-dots">...</span>
                    @endif
                @endforeach
            </div>
            <button class="page-nav" {{ $empleados->currentPage() === $empleados->lastPage() ? 'disabled' : '' }}
                    onclick="window.location='{{ $empleados->nextPageUrl() }}'">
                Siguiente <i class="fa fa-angle-right"></i>
            </button>
        </div>
        @endif

    </div>

    {{-- MODALES DE BAJA --}}
    @foreach($empleados as $empleado)
        @if(!$empleado->deleted_at)
            @can('empleados.baja')
            @include('Modules.Empleados.components.modal-baja', [
                'id'     => $empleado->id,
                'nombre' => $empleado->nombre . ' ' . $empleado->apellido,
            ])
            @endcan
        @endif
    @endforeach

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush
