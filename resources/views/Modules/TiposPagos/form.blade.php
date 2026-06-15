@extends('layouts.app')

@section('title', isset($tipoPago) ? 'Editar Tipo de Pago' : 'Nuevo Tipo de Pago')

@section('page-title', isset($tipoPago) ? 'Editar Tipo de Pago' : 'Nuevo Tipo de Pago')
@section('page-subtitle', isset($tipoPago) ? 'Actualiza la información del tipo de pago' : 'Registra un nuevo tipo de pago')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-body">

            <form
                action="{{ isset($tipoPago) ? route('tipos-pago.update', $tipoPago->id) : route('tipos-pago.store') }}"
                method="POST">

                @csrf

                @if(isset($tipoPago))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control"
                        value="{{ old('nombre', $tipoPago->nombre ?? '') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label for="codigo" class="form-label">Código</label>
                    <input
                        type="text"
                        id="codigo"
                        name="codigo"
                        class="form-control"
                        value="{{ old('codigo', $tipoPago->codigo ?? '') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        class="form-control"
                        rows="4">{{ old('descripcion', $tipoPago->descripcion ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="unidad_calculo" class="form-label">Unidad de Cálculo</label>
                    <select id="unidad_calculo" name="unidad_calculo" class="form-control" required>
                        @php
                            $unidades = ['salario' => 'Salario', 'dia' => 'Día', 'hora' => 'Hora', 'porcentaje' => 'Porcentaje', 'unidad' => 'Unidad'];
                        @endphp
                        @foreach($unidades as $value => $label)
                            <option value="{{ $value }}" {{ old('unidad_calculo', $tipoPago->unidad_calculo ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($tipoPago) ? 'Actualizar' : 'Crear' }}
                </button>

                <a href="{{ route('tipos-pago.index') }}" class="btn btn-secondary ms-2">
                    Volver
                </a>

            </form>

        </div>
    </div>
</div>

@endsection
