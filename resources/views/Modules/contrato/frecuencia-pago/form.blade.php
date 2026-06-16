@extends('layouts.app')

@section('title', isset($frecuenciaPago) ? 'Editar Frecuencia de Pago' : 'Nueva Frecuencia de Pago')

@section('page-title', 'Frecuencias de Pago')
@section('page-subtitle', isset($frecuenciaPago) ? 'Modificar datos de la frecuencia de pago' : 'Registrar nueva frecuencia de pago')

@section('content')

<div class="cargo-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">

            <div>
                <h5 class="mb-1 fw-bold text-dark">
                    {{ isset($frecuenciaPago) ? 'Editar Frecuencia de Pago' : 'Nueva Frecuencia de Pago' }}
                </h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    {{ isset($frecuenciaPago) ? 'Modificá los datos de la frecuencia de pago seleccionada' : 'Completá los campos para registrar una nueva frecuencia de pago' }}
                </p>
            </div>

            <a href="{{ route('frecuencia-pago.index') }}" class="btn-back-link">
                <i class="fa fa-arrow-left me-2"></i>Volver al listado
            </a>

        </div>
    </div>

    {{-- ALERTAS --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
             style="border-radius: 10px; border: none; background: #fee2e2; color: #991b1b; font-size: 0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
             style="border-radius: 10px; border: none; background: #d1fae5; color: #065f46; font-size: 0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <div class="card form-card">
        <div class="card-body px-4 py-4">

            <form
                method="POST"
                action="{{ isset($frecuenciaPago) ? route('frecuencia-pago.update', $frecuenciaPago->id) : route('frecuencia-pago.store') }}"
                id="frecuenciaPagoForm"
            >
                @csrf
                @if(isset($frecuenciaPago))
                    @method('PUT')
                @endif

                <div class="form-section-title">Información General</div>

                <div class="row g-4">

                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label-custom">
                            Nombre de la Frecuencia <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control-custom @error('nombre') is-invalid-custom @enderror"
                            placeholder="Ej: Mensual, Quincenal, Semanal..."
                            value="{{ old('nombre', $frecuenciaPago->nombre ?? '') }}"
                            maxlength="100"
                        >
                        @error('nombre')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="descripcion" class="form-label-custom">
                            Descripción
                        </label>
                        <textarea
                            id="descripcion"
                            name="descripcion"
                            class="form-control-custom form-textarea-custom @error('descripcion') is-invalid-custom @enderror"
                            placeholder="Describí brevemente esta frecuencia de pago..."
                            rows="4"
                            maxlength="500"
                        >{{ old('descripcion', $frecuenciaPago->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <div class="field-hint">Máximo 500 caracteres. Campo opcional.</div>
                    </div>

                </div>

                <hr class="form-divider">

                <div class="form-actions">

                    <a href="{{ route('frecuencia-pago.index') }}" class="btn-cancel-custom">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-create-custom">
                        <i class="fa fa-floppy-disk me-2"></i>
                        {{ isset($frecuenciaPago) ? 'Guardar cambios' : 'Crear Frecuencia de Pago' }}
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
@endpush
