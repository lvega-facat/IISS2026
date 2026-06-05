@extends('layouts.app')

@section('title', 'Tipos de Contrato')

@section('page-title', 'Tipos de Contrato')
@section('page-subtitle', 'Gestión de contratos laborales y configuraciones asociadas')

@section('content')

<div class="cargo-page">

    <div class="card top-card mb-4">
        <div class="card-body">
            <button class="btn btn-primary btn-new" data-bs-toggle="modal" data-bs-target="#createContratoModal">
                <i class="fa fa-plus me-2"></i>Nuevo Tipo de Contrato
            </button>
        </div>
    </div>

    <div class="card table-card">

        <div class="list-header">
            <div class="header-col text-id">ID</div>
            <div class="header-col text-contrato">Contrato</div>
            <div class="header-col text-profesion">Profesión</div>
            <div class="header-col text-horario">Horario Laboral</div>
            <div class="header-col text-pago">Tipo/Frecuencia Pago</div>
            <div class="header-col text-status text-center">Estado</div>
            <div class="header-col text-actions text-end">Acciones</div>
        </div>

        {{-- Registros dinámicos --}}
        {{-- Aquí se renderizarán los tipos de contrato desde la BD --}}

        <div class="p-4 text-center text-muted">
            <i class="fa fa-folder-open-o d-block mb-2 fs-3"></i>
            No existen tipos de contrato registrados.
        </div>

    </div>

</div>

@include('Modules.contrato.components.modal-create')

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush