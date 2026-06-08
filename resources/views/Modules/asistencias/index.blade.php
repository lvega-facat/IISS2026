@extends('layouts.app')

@section('title', 'Asistencias')
@section('page-title', 'Asistencias')
@section('page-subtitle', 'Marcación de entrada y salida de empleados')

@section('content')

@include('Modules.asistencias.modals.manual')

<div class="card shadow-sm border-0">
    <div class="card-body">

        {{-- BOTONES PRINCIPALES --}}
        <div class="d-flex gap-2 mb-4">

            <form action="{{ route('asistencias.entrada') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    Marcar Entrada
                </button>
            </form>

            <form action="{{ route('asistencias.salida') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">
                    Marcar Salida
                </button>
            </form>

            <button class="btn btn-secondary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalManualAsistencia">
                Marcación Manual (RRHH)
            </button>

        </div>

        {{-- TABLA HISTORIAL --}}
        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Estado</th>
                        <th>Tardanza (min)</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- TODO: backend data --}}
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Sin registros
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

@endsection