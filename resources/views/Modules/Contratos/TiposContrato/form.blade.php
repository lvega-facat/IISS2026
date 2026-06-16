@extends('layouts.app')

{{-- Capturamos el parámetro de la URL de forma limpia con Blade/PHP para simular el cambio de estado --}}
@php 
    $isEdit = request()->get('mode') === 'edit';
@endphp

@section('title', $isEdit ? 'Editar Tipo de Contrato' : 'Nuevo Tipo de Contrato')

@section('page-title', 'Estructura Organizacional')
@section('page-subtitle', $isEdit ? 'Modificar datos del tipo de contrato existente' : 'Registrar un nuevo tipo de contrato en el sistema')

@section('content')

<div class="module-page">

    {{-- ENCABEZADO DINÁMICO DEL FRONTEND --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1 fw-bold text-dark">
                    {{ $isEdit ? 'Editar Tipo de Contrato' : 'Nuevo Tipo de Contrato' }}
                </h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    {{ $isEdit ? 'Modificá los datos del tipo de contrato seleccionado' : 'Completá los campos para registrar un nuevo tipo de contrato' }}
                </p>
            </div>
            {{-- Enlace estático de regreso al index de desarrollo --}}
            <a href="/dev/contrato/tipo-contrato" class="btn-back-link" style="text-decoration: none;">
                <i class="fa fa-arrow-left me-2"></i>Volver al listado
            </a>
        </div>
    </div>

    {{-- FORMULARIO ESTÁTICO (Solo diseño) --}}
    <div class="card module-card">
        <div class="card-body px-4 py-4">

            <form action="#" method="GET" onsubmit="event.preventDefault(); alert('Botón presionado (Simulación Frontend realizada con éxito)');">

                {{-- TÍTULO DE LA SECCIÓN --}}
                <div class="form-section-title" style="font-weight: bold; margin-bottom: 1.5rem; color: #1e293b;">
                    {{ $isEdit ? 'Modificar Configuración Contractual' : 'Información del Nuevo Tipo de Contrato' }}
                </div>

                <div class="row g-4">

                    {{-- Campo: Nombre --}}
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label-custom">
                            Nombre del Tipo de Contrato <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="nombre"
                            class="form-control-custom"
                            placeholder="Ej: Planta Permanente Completo, Prestación de Servicios..."
                            value="{{ $isEdit ? 'Plante Permanente Completo' : '' }}"
                            required
                        >
                    </div>

                    {{-- Campo: Profesión --}}
                    <div class="col-12 col-md-6">
                        <label for="id_profesion" class="form-label-custom">
                            Profesión Asociada <span class="text-danger">*</span>
                        </label>
                        <select id="id_profesion" class="form-control-custom form-select-custom" required>
                            <option value="">Seleccioná una profesión</option>
                            <option value="1" {{ $isEdit ? 'selected' : '' }}>Contador Senior</option>
                            <option value="2">Desarrollador Backend</option>
                            <option value="3">Diseñador UX/UI</option>
                        </select>
                    </div>

                    {{-- Campo: Horario --}}
                    <div class="col-12 col-md-6">
                        <label for="id_horario" class="form-label-custom">
                            Horario Laboral Asociado <span class="text-danger">*</span>
                        </label>
                        <select id="id_horario" class="form-control-custom form-select-custom" required>
                            <option value="">Seleccioná un horario laboral</option>
                            <option value="1" {{ $isEdit ? 'selected' : '' }}>Lun a Vie 08:00 - 17:00 (40h)</option>
                            <option value="2">Flexible / Remoto (40h)</option>
                            <option value="3">Lun a Vie 08:00 - 12:00 (20h)</option>
                        </select>
                    </div>

                    {{-- Campo: Descripción --}}
                    <div class="col-12 col-md-6">
                        <label for="descripcion" class="form-label-custom">
                            Descripción del Contrato
                        </label>
                        <textarea
                            id="descripcion"
                            class="form-control-custom"
                            placeholder="Detallá las condiciones generales o cláusulas base..."
                            rows="1"
                            style="resize: none;"
                        >{{ $isEdit ? 'Contratación por tiempo indefinido con prestaciones completas.' : '' }}</textarea>
                    </div>

                </div>

                {{-- Línea divisoria decorativa --}}
                <hr class="form-divider" style="margin: 2rem 0; border-color: #e2e8f0;">

                {{-- BOTONERA DE ACCIONES --}}
                <div class="form-actions d-flex justify-content-end gap-3">

                    <a href="/dev/contrato/tipo-contrato" class="btn-cancel-custom" style="text-decoration: none;">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-create-custom">
                        <i class="fa {{ $isEdit ? 'fa-square-check' : 'fa-floppy-disk' }} me-2"></i>
                        {{ $isEdit ? 'Guardar cambios' : 'Crear Tipo de Contrato' }}
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules_v2.css') }}">
@endpush