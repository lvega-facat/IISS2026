@extends('layouts.app')

@section('title', 'Tipos de Pago')

@section('page-title', 'Tipos de Pago')
@section('page-subtitle', 'Gestión de tipos de pago utilizados por la organización')

@section('content')

<div class="cargo-page">

    {{-- ALERTAS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
             style="border-radius: 10px; border: none; background: #d1fae5; color: #065f46; font-size: 0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
             style="border-radius: 10px; border: none; background: #fee2e2; color: #991b1b; font-size: 0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card top-card mb-4">
        <div class="card-body">

            <a href="{{ route('tipos-pago.create') }}" class="btn btn-primary btn-new">
                <i class="fa fa-plus me-2"></i>
                Nuevo Tipo de Pago
            </a>

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
                    placeholder="Buscar tipo de pago">
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
        <div class="list-header tipo-pago-header">
            <div>ID</div>
            <div>Tipo de Pago</div>
            <div>Descripción</div>
            <div class="text-center">Estado</div>
            <div class="text-end">Acciones</div>
        </div>

        {{-- FILAS --}}
        @forelse($tiposPago as $tp)

            <div class="cargo-row tipo-pago-row">

                <div>{{ $tp->id }}</div>

                <div>{{ $tp->nombre }}</div>

                <div>{{ $tp->descripcion ?? '—' }}</div>

                <div class="text-center">
                    <span class="status-badge {{ $tp->estado ? 'active' : 'inactive' }}">
                        {{ $tp->estado ? 'Activo' : 'Inactivo' }}
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
                                <a class="dropdown-item" href="{{ route('tipos-pago.edit', $tp->id) }}">
                                    <i class="fa fa-pencil me-2"></i>Editar
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('tipos-pago.gestionar', $tp->id) }}">
                                    <i class="fa fa-link me-2"></i>Gestionar Frecuencias
                                </a>
                            </li>

                            <li>
                                <form action="{{ route('tipos-pago.toggle', $tp->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="dropdown-item {{ $tp->estado ? 'text-warning' : 'text-success' }}">
                                        <i class="fa {{ $tp->estado ? 'fa-ban' : 'fa-check' }} me-2"></i>
                                        {{ $tp->estado ? 'Desactivar' : 'Reactivar' }}
                                    </button>
                                </form>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#eliminarTipoPago{{ $tp->id }}">
                                    <i class="fa fa-trash me-2"></i>Eliminar
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            @include('Modules.contrato.tipos-pago.components.modal-eliminar', [
                'id'     => $tp->id,
                'nombre' => $tp->nombre,
            ])

        @empty

            <div class="empty-state text-center py-5">
                <p class="text-muted mb-0">No hay tipos de pago registrados.</p>
            </div>

        @endforelse

        {{-- PAGINACIÓN --}}
        @if(method_exists($tiposPago, 'links'))
            <div class="custom-pagination">
                {{ $tiposPago->links() }}
            </div>
        @endif

    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush
