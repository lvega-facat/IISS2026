@extends('layouts.app')

@section('title', 'Organización')
@section('page-title', 'Organización')
@section('page-subtitle', 'Gestión de la organización')

@section('content')

@include('Modules.organizacion.modals.create')
@include('Modules.organizacion.modals.edit')


@if(!$organizacion)

<div class="card shadow-sm border-0">
    <div class="card-body text-center py-5">

        <h3>No existe una organización registrada</h3>

        <p class="text-muted mt-3">
            Debes crear una organización para comenzar a utilizar el sistema.
        </p>

        <button class="btn btn-primary mt-3"
                data-bs-toggle="modal"
                data-bs-target="#modalCreateOrganizacion">
            + Crear Organización
        </button>

    </div>
</div>

@else

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="d-flex gap-2 mb-4">

            <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateOrganizacion">
                + Nueva Organización
            </button>

            <button class="btn btn-secondary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditOrganizacion">
                Editar Organización
            </button>

            <form action="{{ route('organizacion.destroy', $organizacion->id) }}"
                  method="POST"
                  onsubmit="return confirm('¿Seguro que deseas eliminar?')">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger">
                    Eliminar Organización
                </button>

            </form>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <input class="form-control" value="{{ $organizacion->nombre }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">RUC</label>
                <input class="form-control" value="{{ $organizacion->ruc }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Dirección</label>
                <input class="form-control" value="{{ $organizacion->direccion }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <input class="form-control" value="{{ $organizacion->email }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">País</label>
                <input class="form-control" value="{{ $organizacion->pais }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Teléfono</label>
                <input class="form-control" value="{{ $organizacion->telefono }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Sector</label>
                <input class="form-control" value="{{ $organizacion->sector }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Fecha Registro</label>
                <input class="form-control"
                       value="{{ optional($organizacion->fecha_registro)->format('d-m-Y') }}"
                       readonly>
            </div>

            <div class="col-md-12 mt-3">

                <label class="form-label fw-bold">Logo</label>

                @if($organizacion->logo_url)
                    <img src="{{ asset('storage/' . $organizacion->logo_url) }}"
                         class="img-thumbnail"
                         style="max-height: 150px;">
                @else
                    <div class="border rounded p-4 text-muted">
                        Sin imagen
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>

@endif

@endsection