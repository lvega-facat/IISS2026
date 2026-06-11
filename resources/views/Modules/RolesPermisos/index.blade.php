@extends('layouts.app')

@section('title', 'Roles y Permisos')

@section('page-title', 'Roles y Permisos')
@section('page-subtitle', 'Gestión de roles y permisos del sistema')

@section('content')

<div class="roles-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>Nuevo Rol
            </a>
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
<div class="card table-card" style="--table-columns: 200px 1fr 130px 160px 80px;">

    {{-- FILTROS --}}
    <form method="GET" action="{{ route('roles.index') }}">
    <div class="table-toolbar">
        <div class="search-container">
            <input type="text" name="nombre" class="search-input" placeholder="Buscar rol por nombre" value="{{ request('nombre') }}">
        </div>

        <div class="filter-group">
            <select name="estado" class="filter-select">
                <option value="">Estado</option>
                <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
            <button type="submit" class="btn-search">Buscar</button>
        </div>
    </div>
    </form>

    {{-- CABECERA (Cambiado a list-header para que tome los px) --}}
    <div class="list-header">
        <div>Nombre del Rol</div>
        <div>Descripción</div>
        <div class="text-center">Estado</div>
        <div>Fecha de creación</div>
        <div class="text-end">Acciones</div>
    </div>

    {{-- FILAS DINÁMICAS --}}
    @forelse($roles as $rol)
    <div class="cargo-row">
        <div class="role-name">{{ $rol->nombre }}</div>
        <div class="role-desc">{{ $rol->descripcion ?? '—' }}</div>
        <div class="text-center">
            <span class="status-badge {{ $rol->estado ? 'active' : 'inactive' }}">
                {{ $rol->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </div>
        <div>{{ $rol->created_at?->format('d/m/Y') ?? '—' }}</div>
        <div class="text-end">
            <div class="dropdown">
                <button class="action-btn" type="button" data-bs-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{ route('roles.edit', $rol->id) }}" class="dropdown-item"><i class="fa fa-pencil me-2"></i>Editar</a></li>
                    <li><a href="{{ route('roles.permissions', $rol->id) }}" class="dropdown-item"><i class="fa fa-lock me-2"></i>Permisos</a></li>
                    <li><a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal{{ $rol->id }}"><i class="fa fa-trash me-2"></i>Eliminar</a></li>
                </ul>
            </div>
        </div>
    </div>
    @empty
    <div class="cargo-row">
        <div class="text-center text-muted py-3" style="grid-column: 1 / -1;">
            No se encontraron roles.
        </div>
    </div>
    @endforelse

    {{-- PAGINACIÓN --}}
    <div class="custom-pagination">
        <button class="page-nav" {{ $roles->onFirstPage() ? 'disabled' : '' }} onclick="{{ $roles->onFirstPage() ? 'void(0)' : 'window.location=\''.($roles->previousPageUrl() ?? '#').'\'' }}">
            <i class="fa fa-angle-left"></i> Atrás
        </button>
        <div class="page-numbers">
            @php
                $current = $roles->currentPage();
                $last    = $roles->lastPage();
            @endphp

            @for($page = 1; $page <= $last; $page++)
                @if($page === 1 || $page === $last || abs($page - $current) <= 1)
                    <button class="page-item {{ $current === $page ? 'active' : '' }}"
                        onclick="window.location='{{ $roles->url($page) }}'">{{ $page }}</button>
                @elseif($page === $current - 2 || $page === $current + 2)
                    <span class="pagination-dots">...</span>
                @endif
            @endfor
        </div>
        <button class="page-nav" {{ !$roles->hasMorePages() ? 'disabled' : '' }} onclick="{{ $roles->hasMorePages() ? 'window.location=\''.($roles->nextPageUrl() ?? '#').'\'' : 'void(0)' }}">
            Siguiente <i class="fa fa-angle-right"></i>
        </button>
    </div>

</div>

@foreach($roles as $rol)
    @include('Modules.RolesPermisos.components.modal-eliminar', ['id' => $rol->id, 'nombre' => $rol->nombre])
@endforeach
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush