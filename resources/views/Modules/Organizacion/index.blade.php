@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Organización</h2>

    <a href="#" class="btn btn-primary">
        Registrar Organización
    </a>
</div>

{{-- Estado con datos --}}

<div class="card p-4 mb-4">

    <h4 class="mb-4">Tech Solutions S.A.</h4>

    <div class="row">

        <div class="col-md-6 mb-3">
            <strong>RUC:</strong>
            <p>80012345-6</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Fecha Registro:</strong>
            <p>01/01/2026</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Dirección:</strong>
            <p>Av. San Blas 123</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>País:</strong>
            <p>Paraguay</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Email:</strong>
            <p>empresa@correo.com</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Teléfono:</strong>
            <p>0981 123 456</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Sector:</strong>
            <p>Tecnología</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Fecha creación:</strong>
            <p>01/01/2026</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Última actualización:</strong>
            <p>05/06/2026</p>
        </div>

    </div>

    <div class="mt-4">

        <a href="#" class="btn btn-primary">
            Editar
        </a>

        <button class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#modalEliminar">
            Eliminar
        </button>

    </div>

</div>

{{-- Estado vacío --}}

<div class="card p-5 text-center">

    <h4>No existe organización registrada</h4>

    <p class="text-muted">
        Debe registrar una organización para comenzar a utilizar el sistema.
    </p>

    <a href="#" class="btn btn-primary">
        Registrar Organización
    </a>

</div>

@include('Modules.organizacion.components.modal-eliminar')

@endsection