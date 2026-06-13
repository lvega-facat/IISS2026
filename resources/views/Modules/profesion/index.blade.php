@extends('layouts.app')

@section('title', 'Gestión de Profesiones')

@section('content')
    <style>
        .prof-wrap { max-width: 960px; margin: 0 auto; }
        .prof-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .prof-btn { display: inline-block; padding: 8px 14px; border: 1px solid #2563eb; background: #2563eb; color: #fff; border-radius: 6px; text-decoration: none; font-size: 14px; cursor: pointer; }
        .prof-btn-secondary { background: #fff; color: #2563eb; }
        .prof-filtros { display: flex; gap: 12px; align-items: flex-end; margin-bottom: 16px; flex-wrap: wrap; }
        .prof-filtros label { display: block; font-size: 12px; color: #555; margin-bottom: 4px; }
        .prof-filtros input, .prof-filtros select { padding: 6px 8px; border: 1px solid #ccc; border-radius: 6px; }
        table.prof-tabla { width: 100%; border-collapse: collapse; }
        table.prof-tabla th, table.prof-tabla td { text-align: left; padding: 10px 12px; border-bottom: 1px solid #e5e7eb; font-size: 14px; }
        table.prof-tabla th { background: #f9fafb; color: #374151; }
        .badge { padding: 2px 8px; border-radius: 999px; font-size: 12px; }
        .badge-activo { background: #dcfce7; color: #166534; }
        .badge-inactivo { background: #fee2e2; color: #991b1b; }
        .acciones a, .acciones button { font-size: 13px; margin-right: 8px; }
        .vacio { text-align: center; color: #888; padding: 24px; }
    </style>

    <div class="prof-wrap">
        <div class="prof-header">
            <h2>Gestión de Profesiones</h2>
            <a href="{{ url('/dev/profesion/crear') }}" class="prof-btn">+ Nueva Profesión</a>
        </div>

        {{-- Filtros opcionales: buscar por nombre y filtrar por estado --}}
        <form method="GET" class="prof-filtros">
            <div>
                <label for="buscar">Buscar por nombre</label>
                <input type="text" id="buscar" name="buscar" value="{{ request('buscar') }}" placeholder="Ej: Médico...">
            </div>
            <div>
                <label for="estado">Estado</label>
                <select id="estado" name="estado">
                    <option value="">Todos</option>
                    <option value="1" @selected(request('estado') === '1')>Activo</option>
                    <option value="0" @selected(request('estado') === '0')>Inactivo</option>
                </select>
            </div>
            <div>
                <button type="submit" class="prof-btn prof-btn-secondary">Filtrar</button>
            </div>
        </form>

        <table class="prof-tabla">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($profesiones ?? [] as $profesion)
                    <tr>
                        <td>{{ $profesion['nombre'] }}</td>
                        <td>{{ $profesion['descripcion'] }}</td>
                        <td>
                            @if($profesion['activo'])
                                <span class="badge badge-activo">Activo</span>
                            @else
                                <span class="badge badge-inactivo">Inactivo</span>
                            @endif
                        </td>
                        <td class="acciones">
                            <a href="{{ url('/dev/profesion/ver') }}">Ver</a>
                            <a href="{{ url('/dev/profesion/editar') }}">Editar</a>
                            {{-- Desactivar: en el sistema real iría dentro de un <form> con method DELETE/PATCH --}}
                            <a href="#" onclick="return confirm('¿Desactivar esta profesión?')">Desactivar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="vacio">No hay profesiones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
