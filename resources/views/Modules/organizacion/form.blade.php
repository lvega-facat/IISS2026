@extends('layouts.app')

@section('content')

@php
    $isEdit = isset($organizacion) && $organizacion;
@endphp

<div class="card p-4">

    <h3 class="mb-4">
        {{ $isEdit ? 'Editar' : 'Crear' }} Organización
    </h3>

    <form>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Nombre *</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ $organizacion->nombre ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">RUC *</label>
                <input type="text"
                       name="ruc"
                       class="form-control"
                       value="{{ $organizacion->ruc ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha registro *</label>
                <input type="date"
                       name="fecha_registro"
                       class="form-control"
                       value="{{ isset($organizacion->fecha_registro)
                            ? \Carbon\Carbon::parse($organizacion->fecha_registro)->format('Y-m-d')
                            : '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Dirección *</label>
                <input type="text"
                       name="direccion"
                       class="form-control"
                       value="{{ $organizacion->direccion ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">País *</label>
                <input type="text"
                       name="pais"
                       class="form-control"
                       value="{{ $organizacion->pais ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email *</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ $organizacion->email ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Teléfono *</label>
                <input type="text"
                       name="telefono"
                       class="form-control"
                       value="{{ $organizacion->telefono ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Sector *</label>
                <input type="text"
                       name="sector"
                       class="form-control"
                       value="{{ $organizacion->sector ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Logo</label>
                <input type="file"
                       name="logo"
                       class="form-control">
            </div>

            @if($isEdit && !empty($organizacion->logo_url))
                <div class="col-md-12 mb-3">
                    <label class="form-label">Logo actual</label>
                    <br>
                    <img src="{{ asset('storage/'.$organizacion->logo_url) }}"
                         class="img-thumbnail"
                         style="max-height: 120px;">
                </div>
            @endif

        </div>

        <div class="mt-3">

            <button type="button" class="btn btn-primary">
                Guardar (UI)
            </button>

            <a href="{{ route('organizacion.show') }}"
               class="btn btn-secondary">
                Volver
            </a>

        </div>

    </form>

</div>

@endsection