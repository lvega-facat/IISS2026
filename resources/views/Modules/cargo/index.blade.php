@extends('layouts.app')

@section('title', 'Cargo')

@section('page-title', 'Cargos')
@section('page-subtitle', 'Gestión de cargos organizacionales por departamento')

@section('content')

<div class="cargo-page">

    <div class="card top-card mb-4">
        <div class="card-body">
            <button class="btn btn-primary btn-new" data-bs-toggle="modal" data-bs-target="#createCargoModal">
                <i class="fa fa-plus me-2"></i>Nuevo Cargo
            </button>
        </div>
    </div>

    <div class="card table-card">

        <div class="list-header">
            <div class="header-col text-id">ID</div>
            <div class="header-col text-cargo">Cargo</div>
            <div class="header-col text-dept">Departamento</div>
            <div class="header-col text-superior">Superior</div>
            <div class="header-col text-status text-center">Estado</div>
            <div class="header-col text-actions text-end">Acciones</div>
        </div>


        <div class="p-4 text-center text-muted">
            <i class="fa fa-folder-open-o d-block mb-2 fs-3"></i>
            Sin datos cargados. La tabla renderizará los registros dinámicamente aquí.
        </div>


    </div>
</div>
@include('Modules.cargo.components.modal-create')
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush