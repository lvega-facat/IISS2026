@extends('layouts.app')

@section('content')

@if(!isset($organizacion) || !$organizacion)

<div class="text-center p-5">

    <h3>No existe organización registrada</h3>

    <a href="{{ route('organizacion.form') }}"
       class="btn btn-primary mt-3">
        Registrar Organización
    </a>

</div>

@else

<div class="card p-4">

    <h3 class="mb-4">
        {{ $organizacion->nombre }}
    </h3>

    <div class="row">

        <div class="col-md-6 mb-3">
            <strong>RUC:</strong>
            <p>{{ $organizacion->ruc }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Fecha Registro:</strong>
            <p>{{ $organizacion->fecha_registro }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Dirección:</strong>
            <p>{{ $organizacion->direccion }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>País:</strong>
            <p>{{ $organizacion->pais }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Email:</strong>
            <p>{{ $organizacion->email }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Teléfono:</strong>
            <p>{{ $organizacion->telefono }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Sector:</strong>
            <p>{{ $organizacion->sector }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Fecha creación:</strong>
            <p>{{ $organizacion->created_at }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <strong>Última actualización:</strong>
            <p>{{ $organizacion->updated_at }}</p>
        </div>

        <div class="col-md-12 mt-3">

            <strong>Logo:</strong>

            <div class="mt-2">

                @if(!empty($organizacion->logo_url))
                    <img src="{{ asset('storage/'.$organizacion->logo_url) }}"
                         class="img-thumbnail"
                         style="max-height:150px;">
                @else
                    <p class="text-muted">
                        Sin logo
                    </p>
                @endif

            </div>

        </div>

    </div>

    <div class="mt-4">

        <a href="{{ route('organizacion.form') }}"
           class="btn btn-primary">
            Editar Organización
        </a>

        <button type="button"
                class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#modalEliminar">
            Eliminar
        </button>

    </div>

</div>

@include('Modules.organizacion.components.modal-eliminar')

@endif

@endsection