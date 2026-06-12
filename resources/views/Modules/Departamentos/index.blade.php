@extends('layouts.app')

@section('title', 'Departamentos')

@section('page-title', 'Departamentos')
@section('page-subtitle', 'Gestión de departamentos organizacionales')

@section('content')

<div class="cargo-page">

    {{-- MENSAJES ERROR B2F --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- BOTÓN NUEVO --}}
    <div class="card top-card mb-4">
        <div class="card-body">

            @can(\App\Modules\RolesPermisos\Enums\Permisos::DEPARTAMENTOS_CREAR) 
            <button class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>
                Nuevo Departamento
            </button>
            @endcan

        </div>
    </div>

    <div class="card table-card">

        {{-- FILTROS --}}
        <div class="table-toolbar">

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Buscar por nombre">
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Buscar por código">
            </div>

            <div class="filter-group">

                <select class="filter-select">
                    <option value="">Todos</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>

                <button class="btn-search">
                    Buscar
                </button>

            </div>

        </div>

        {{-- CABECERA --}}
        <div class="list-header">
            <div>Nombre</div>
            <div>Código</div>
            <div>Función Principal</div>
            <div>Departamento Padre</div>
            <div class="text-center">Empleados Activos</div>
            <div class="text-center">Estado</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- FILAS --}}
        @forelse($departamentos as $departamento)

        <div class="cargo-row">

            <div class="cargo-title">
                {{ $departamento->nombre }}
            </div>

            <div>
                {{ $departamento->codigo }}
            </div>

            <div>
                {{ $departamento->funcion_principal }}
            </div>

            <div>
                {{ $departamento->departamento_padre ?? 'Ninguno' }}
            </div>

            <div class="text-center">
                {{ $departamento->cantidad_empleados }}
            </div>

            <div class="text-center">

                @if($departamento->estado)
                    <span class="status-badge active">Activo</span>
                @else
                    <span class="status-badge inactive">Inactivo</span>
                @endif

            </div>

            <div class="text-end">

                <div class="dropdown">
                    <button class="action-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        @can(\App\Modules\RolesPermisos\Enums\Permisos::DEPARTAMENTOS_EDITAR)
                        <li>
                            <a class="dropdown-item">Editar</a>
                        </li>
                        @endcan

                        @can(\App\Modules\RolesPermisos\Enums\Permisos::DEPARTAMENTOS_ELIMINAR)
                        <li>
                            <a class="dropdown-item">
                                {{ $departamento->estado ? 'Desactivar' : 'Activar' }}
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>

            </div>

        </div>

        @empty

        <div class="p-4 text-center text-muted">
            No hay departamentos registrados.
        </div>

        @endforelse

        {{-- PAGINACIÓN (OBLIGATORIA) --}}
        <div class="mt-4 p-3">
            {{ $departamentos->links() }}
        </div>

    </div>

</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush