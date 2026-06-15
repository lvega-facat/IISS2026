@extends('layouts.app')

@section('title', 'Tipos de Pago')

@section('page-title', 'Tipos de Pago')
@section('page-subtitle', 'Gestión de tipos de pago utilizados por la organización')

@section('content')

<div class="cargo-page">

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

            <div class="text-center">
                Estado
            </div>

            <div class="text-end">
                Acciones
            </div>

        </div>

        {{-- CONTENIDO DINÁMICO --}}
        @forelse($tiposPago as $tipoPago)
            <div class="cargo-row tipo-pago-row">

                <div>{{ $tipoPago->id }}</div>

                <div>{{ $tipoPago->nombre }}</div>

                <div>{{ $tipoPago->descripcion }}</div>

                <div class="text-center">
                    <span class="status-badge {{ $tipoPago->estado ? 'active' : 'inactive' }}">
                        {{ $tipoPago->estado ? 'Activo' : 'Inactivo' }}
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
                                    href="{{ route('tipos-pago.edit', $tipoPago->id) }}">

                                    <i class="fa fa-pencil me-2"></i>
                                    Editar

                                </a>
                            </li>

                            @if($tipoPago->estado)
                                <li>
                                    <form action="{{ route('tipos-pago.desactivar', $tipoPago->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="dropdown-item text-warning">
                                            <i class="fa fa-ban me-2"></i>
                                            Desactivar
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <form action="{{ route('tipos-pago.activar', $tipoPago->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="dropdown-item text-success">
                                            <i class="fa fa-check me-2"></i>
                                            Activar
                                        </button>
                                    </form>
                                </li>
                            @endif

                        </ul>

                    </div>

                </div>

            </div>
        @empty
            <div class="cargo-row tipo-pago-row">
                <div colspan="5" class="text-center p-4 text-muted">
                    No hay tipos de pago disponibles.
                </div>
            </div>
        @endforelse

    </div>

</div>

@endsection
