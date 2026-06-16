@extends('layouts.app')

@section('title', 'Gestionar Frecuencias')

@section('page-title', 'Tipos de Pago')
@section('page-subtitle', 'Vincular frecuencias de pago al tipo seleccionado')

@section('content')

<div class="cargo-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">

            <div>
                <h5 class="mb-1 fw-bold text-dark">Gestionar Frecuencias</h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    Seleccioná las frecuencias de pago asociadas a este tipo
                </p>
            </div>

            <a href="{{ route('tipos-pago.index') }}" class="btn-back-link">
                <i class="fa fa-arrow-left me-2"></i>Volver al listado
            </a>

        </div>
    </div>

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

    <form action="{{ route('tipos-pago.guardar-frecuencias', $tiposPago->id) }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- COLUMNA IZQUIERDA: info del tipo de pago --}}
            <div class="col-12 col-lg-4">
                <div class="card form-card sticky-lg-top" style="top: 20px; z-index: 10;">
                    <div class="card-body px-4 py-4">

                        <div class="form-section-title">
                            <i class="fa fa-credit-card me-2 text-primary"></i>Tipo de Pago
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Nombre</label>
                            <input
                                type="text"
                                class="form-control-custom fw-bold bg-light"
                                value="{{ $tiposPago->nombre }}"
                                readonly>
                        </div>

                        @if($tiposPago->descripcion)
                            <div class="mb-3">
                                <label class="form-label-custom">Descripción</label>
                                <textarea
                                    class="form-control-custom bg-light"
                                    rows="3"
                                    readonly>{{ $tiposPago->descripcion }}</textarea>
                            </div>
                        @endif

                        <div class="mb-0">
                            <label class="form-label-custom">Estado</label>
                            <div class="mt-1">
                                <span class="status-badge {{ $tiposPago->estado ? 'active' : 'inactive' }}">
                                    {{ $tiposPago->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                            <small class="text-muted d-block mt-2">
                                Las frecuencias seleccionadas generarán las combinaciones disponibles para asignar a los contratos.
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA: checkboxes de frecuencias --}}
            <div class="col-12 col-lg-8">
                <div class="card form-card">
                    <div class="card-body px-4 py-4">

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
                            <div class="form-section-title mb-0 border-bottom-0 pb-0">
                                <i class="fa fa-clock me-2 text-primary"></i>Frecuencias de Pago disponibles
                            </div>
                        </div>

                        @forelse($frecuencias as $f)

                            <div class="perms-module-block mb-3">
                                <label class="perm-check-label d-flex align-items-start gap-3" style="cursor: pointer;">

                                    <input
                                        type="checkbox"
                                        name="frecuencias[]"
                                        value="{{ $f->id }}"
                                        {{ in_array($f->id, $seleccionadas ?? []) ? 'checked' : '' }}
                                        style="margin-top: 3px; flex-shrink: 0;">

                                    <div>
                                        <span class="fw-semibold d-block">{{ $f->nombre }}</span>
                                        @if($f->descripcion)
                                            <small class="text-muted">{{ $f->descripcion }}</small>
                                        @endif
                                    </div>

                                </label>
                            </div>

                        @empty

                            <p class="text-muted text-center py-4 mb-0">
                                No hay frecuencias de pago activas registradas.
                            </p>

                        @endforelse

                        <hr class="form-divider">

                        <div class="form-actions">

                            <a href="{{ route('tipo-pago.index') }}" class="btn-cancel-custom">
                                Cancelar
                            </a>

                            <button type="submit" class="btn-create-custom">
                                <i class="fa fa-floppy-disk me-2"></i>
                                Guardar Combinaciones
                            </button>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </form>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
@endpush
