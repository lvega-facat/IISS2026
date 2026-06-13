@extends('layouts.app')

@section('title', 'Detalle de Profesión')

@section('content')
    <style>
        .prof-show-wrap { max-width: 560px; margin: 0 auto; }
        .prof-show-wrap dl { border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; }
        .prof-show-wrap dt { background: #f9fafb; padding: 8px 12px; font-size: 12px; color: #6b7280; text-transform: uppercase; }
        .prof-show-wrap dd { margin: 0; padding: 10px 12px; font-size: 15px; border-bottom: 1px solid #e5e7eb; }
        .prof-show-wrap dd:last-child { border-bottom: none; }
        .badge { padding: 2px 8px; border-radius: 999px; font-size: 12px; }
        .badge-activo { background: #dcfce7; color: #166534; }
        .badge-inactivo { background: #fee2e2; color: #991b1b; }
        .prof-actions { margin-top: 18px; display: flex; gap: 10px; }
        .prof-btn { padding: 9px 16px; border: 1px solid #2563eb; background: #2563eb; color: #fff; border-radius: 6px; text-decoration: none; font-size: 14px; }
        .prof-btn-secondary { background: #fff; color: #374151; border-color: #ccc; }
    </style>

    <div class="prof-show-wrap">
        <h2>Detalle de Profesión</h2>

        <dl>
            <dt>Nombre</dt>
            <dd>{{ $profesion['nombre'] ?? '—' }}</dd>

            <dt>Descripción</dt>
            <dd>{{ $profesion['descripcion'] ?? '—' }}</dd>

            <dt>Estado</dt>
            <dd>
                @if($profesion['activo'] ?? false)
                    <span class="badge badge-activo">Activo</span>
                @else
                    <span class="badge badge-inactivo">Inactivo</span>
                @endif
            </dd>

            <dt>Fecha de creación</dt>
            <dd>{{ $profesion['creado_en'] ?? '—' }}</dd>
        </dl>

        <div class="prof-actions">
            <a href="{{ url('/dev/profesion/editar') }}" class="prof-btn">Editar</a>
            <a href="{{ url('/dev/profesion') }}" class="prof-btn prof-btn-secondary">Volver al listado</a>
        </div>
    </div>
@endsection
