@extends('layouts.app')

@php $isEdit = isset($usuario); @endphp

@section('title', $isEdit ? 'Editar Usuario' : 'Crear Usuario')
@section('page-title', 'Usuarios')
@section('page-subtitle', $isEdit ? 'Modificar datos del usuario' : 'Registrar un nuevo usuario en el sistema')

@section('content')

<div class="usuarios-page">

    {{-- ENCABEZADO --}}
    <div class="card top-card mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1 fw-bold text-dark">
                    {{ $isEdit ? 'Editar Usuario' : 'Crear Usuario' }}
                </h5>
                <p class="mb-0 text-muted" style="font-size: 0.88rem;">
                    {{ $isEdit ? 'Modificá los datos del usuario seleccionado' : 'Completá los campos para registrar un nuevo usuario' }}
                </p>
            </div>
            <a href="{{ route('usuarios.index') }}" class="btn-back-link">
                <i class="fa fa-arrow-left me-2"></i>Volver al listado
            </a>
        </div>
    </div>

    {{-- ALERTAS --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
             style="border-radius:10px;border:none;background:#fee2e2;color:#991b1b;font-size:0.9rem;">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
             style="border-radius:10px;border:none;background:#d1fae5;color:#065f46;font-size:0.9rem;">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <form
        method="POST"
        action="{{ $isEdit ? route('usuarios.update', $usuario->id ?? 0) : route('usuarios.store') }}"
    >
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- =====================
             SECCIÓN: DATOS GENERALES
             ===================== --}}
        <div class="card form-card mb-4">
            <div class="card-body px-4 py-4">

                <div class="form-section-title">
                    <i class="fa fa-user me-2 text-primary" style="font-size:0.9rem;"></i>
                    Datos Generales
                </div>

                <div class="row g-4">

                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label-custom">
                            Nombre <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control-custom @error('nombre') is-invalid-custom @enderror"
                            placeholder="Ej: Juan"
                            value="{{ old('nombre', $usuario->nombre ?? '') }}"
                            maxlength="100"
                        >
                        @error('nombre')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="apellido" class="form-label-custom">
                            Apellido <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="apellido"
                            name="apellido"
                            class="form-control-custom @error('apellido') is-invalid-custom @enderror"
                            placeholder="Ej: Pérez"
                            value="{{ old('apellido', $usuario->apellido ?? '') }}"
                            maxlength="100"
                        >
                        @error('apellido')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="correo" class="form-label-custom">
                            Correo Electrónico <span class="text-danger">*</span>
                        </label>
                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="form-control-custom @error('correo') is-invalid-custom @enderror"
                            placeholder="usuario@empresa.com"
                            value="{{ old('correo', $usuario->correo ?? '') }}"
                        >
                        @error('correo')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="telefono" class="form-label-custom">
                            Teléfono <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            class="form-control-custom @error('telefono') is-invalid-custom @enderror"
                            placeholder="+595 981 000 000"
                            value="{{ old('telefono', $usuario->telefono ?? '') }}"
                            maxlength="30"
                        >
                        @error('telefono')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- =====================
             SECCIÓN: SEGURIDAD
             ===================== --}}
        <div class="card form-card mb-4">
            <div class="card-body px-4 py-4">

                <div class="form-section-title">
                    <i class="fa fa-lock me-2 text-primary" style="font-size:0.9rem;"></i>
                    Seguridad
                </div>

                @if(!$isEdit)

                    {{-- MODO CREAR: mostrar campos de contraseña --}}
                    <div class="row g-4">

                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label-custom">
                                Contraseña <span class="text-danger">*</span>
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control-custom @error('password') is-invalid-custom @enderror"
                                placeholder="Mínimo 8 caracteres"
                            >
                            @error('password')
                                <div class="field-error">
                                    <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="field-hint">
                                Mínimo 8 caracteres, una mayúscula, un número y un símbolo.
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="password_confirmation" class="form-label-custom">
                                Confirmar Contraseña <span class="text-danger">*</span>
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control-custom @error('password_confirmation') is-invalid-custom @enderror"
                                placeholder="Repetí la contraseña"
                            >
                            @error('password_confirmation')
                                <div class="field-error">
                                    <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                @else

                    {{-- MODO EDITAR: solo botón de cambio de contraseña --}}
                    <div class="d-flex align-items-center gap-3">
                        <p class="mb-0 text-muted" style="font-size:0.9rem;">
                            La contraseña del usuario no se muestra por seguridad.
                        </p>
                        <a href="{{ route('usuarios.change-password', $usuario->id ?? 0) }}"
                           class="btn-change-password">
                            <i class="fa fa-key me-2"></i>Cambiar Contraseña
                        </a>
                    </div>

                @endif

            </div>
        </div>

        {{-- =====================
             SECCIÓN: ORGANIZACIÓN
             ===================== --}}
        <div class="card form-card mb-4">
            <div class="card-body px-4 py-4">

                <div class="form-section-title">
                    <i class="fa fa-building me-2 text-primary" style="font-size:0.9rem;"></i>
                    Organización
                </div>

                <div class="row g-4">

                    <div class="col-12 col-md-4">
                        <label for="organizacion_id" class="form-label-custom">
                            Organización <span class="text-danger">*</span>
                        </label>
                        <select
                            id="organizacion_id"
                            name="organizacion_id"
                            class="form-control-custom form-select-custom @error('organizacion_id') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná una organización</option>
                            <option value="1" {{ old('organizacion_id', $usuario->organizacion_id ?? '') == '1' ? 'selected' : '' }}>TechCorp</option>
                            <option value="2" {{ old('organizacion_id', $usuario->organizacion_id ?? '') == '2' ? 'selected' : '' }}>DataSoft</option>
                        </select>
                        @error('organizacion_id')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="departamento_id" class="form-label-custom">
                            Departamento <span class="text-danger">*</span>
                        </label>
                        <select
                            id="departamento_id"
                            name="departamento_id"
                            class="form-control-custom form-select-custom @error('departamento_id') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná un departamento</option>
                            <option value="1" {{ old('departamento_id', $usuario->departamento_id ?? '') == '1' ? 'selected' : '' }}>Tecnología</option>
                            <option value="2" {{ old('departamento_id', $usuario->departamento_id ?? '') == '2' ? 'selected' : '' }}>Finanzas</option>
                            <option value="3" {{ old('departamento_id', $usuario->departamento_id ?? '') == '3' ? 'selected' : '' }}>Recursos Humanos</option>
                        </select>
                        @error('departamento_id')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="profesion_id" class="form-label-custom">
                            Profesión / Puesto <span class="text-danger">*</span>
                        </label>
                        <select
                            id="profesion_id"
                            name="profesion_id"
                            class="form-control-custom form-select-custom @error('profesion_id') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná una profesión</option>
                            <option value="1" {{ old('profesion_id', $usuario->profesion_id ?? '') == '1' ? 'selected' : '' }}>Desarrollador</option>
                            <option value="2" {{ old('profesion_id', $usuario->profesion_id ?? '') == '2' ? 'selected' : '' }}>Contador</option>
                            <option value="3" {{ old('profesion_id', $usuario->profesion_id ?? '') == '3' ? 'selected' : '' }}>Analista</option>
                        </select>
                        @error('profesion_id')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- =====================
             SECCIÓN: ROL Y ESTADO
             ===================== --}}
        <div class="card form-card mb-4">
            <div class="card-body px-4 py-4">

                <div class="form-section-title">
                    <i class="fa fa-shield-halved me-2 text-primary" style="font-size:0.9rem;"></i>
                    Rol y Estado
                </div>

                <div class="row g-4">

                    <div class="col-12 col-md-6">
                        <label for="rol_id" class="form-label-custom">
                            Rol <span class="text-danger">*</span>
                        </label>
                        <select
                            id="rol_id"
                            name="rol_id"
                            class="form-control-custom form-select-custom @error('rol_id') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná un rol</option>
                            <option value="1" {{ old('rol_id', $usuario->rol_id ?? '') == '1' ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ old('rol_id', $usuario->rol_id ?? '') == '2' ? 'selected' : '' }}>Supervisor</option>
                            <option value="3" {{ old('rol_id', $usuario->rol_id ?? '') == '3' ? 'selected' : '' }}>Operador</option>
                            <option value="4" {{ old('rol_id', $usuario->rol_id ?? '') == '4' ? 'selected' : '' }}>Auditor</option>
                        </select>
                        @error('rol_id')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="estado" class="form-label-custom">
                            Estado <span class="text-danger">*</span>
                        </label>
                        <select
                            id="estado"
                            name="estado"
                            class="form-control-custom form-select-custom @error('estado') is-invalid-custom @enderror"
                        >
                            <option value="">Seleccioná un estado</option>
                            <option value="1" {{ old('estado', $usuario->estado ?? '') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $usuario->estado ?? '') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- =====================
             SECCIÓN: VINCULACIÓN RRHH
             ===================== --}}
        <div class="card form-card mb-4">
            <div class="card-body px-4 py-4">

                <div class="form-section-title">
                    <i class="fa fa-link me-2 text-primary" style="font-size:0.9rem;"></i>
                    Vinculación con RRHH
                </div>

                <div class="row g-4">

                    <div class="col-12 col-md-8">
                        <label for="empleado_id" class="form-label-custom">
                            Empleado Vinculado <span class="text-danger">*</span>
                        </label>
                        {{-- Se mantiene la clase 'form-control-custom' y se agrega el atributo data-searchable para inicializar un Select Buscable si usas alguna librería JS externa --}}
                        <select
                            id="empleado_id"
                            name="empleado_id"
                            class="form-control-custom form-select-custom @error('empleado_id') is-invalid-custom @enderror"
                        >
                            <option value="">Sin vincular</option>
                            <option value="1" {{ old('empleado_id', $usuario->empleado_id ?? '') == '1' ? 'selected' : '' }}>Empleado 1 — Juan Pérez</option>
                            <option value="2" {{ old('empleado_id', $usuario->empleado_id ?? '') == '2' ? 'selected' : '' }}>Empleado 2 — María García</option>
                            <option value="3" {{ old('empleado_id', $usuario->empleado_id ?? '') == '3' ? 'selected' : '' }}>Empleado 3 — Carlos López</option>
                        </select>
                        @error('empleado_id')
                            <div class="field-error">
                                <i class="fa fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <div class="field-hint">
                            Seleccioná el empleado de RRHH al que pertenece este usuario del sistema.
                            Si no tiene empleado asociado, dejá "Sin vincular".
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- =====================
             SECCIÓN: INFORMACIÓN ADICIONAL (solo edición, readonly)
             ===================== --}}
        @if($isEdit)
        <div class="card form-card mb-4">
            <div class="card-body px-4 py-4">

                <div class="form-section-title">
                    <i class="fa fa-circle-info me-2 text-primary" style="font-size:0.9rem;"></i>
                    Información Adicional
                </div>

                <div class="row g-4">

                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Último Acceso</label>
                        <input
                            type="text"
                            class="form-control-custom"
                            value="{{ $usuario->ultimo_acceso ?? '—' }}"
                            readonly
                        >
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Intentos Fallidos</label>
                        <input
                            type="text"
                            class="form-control-custom"
                            value="{{ $usuario->intentos_fallidos ?? '0' }}"
                            readonly
                        >
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Bloqueado Hasta</label>
                        <input
                            type="text"
                            class="form-control-custom"
                            value="{{ $usuario->bloqueado_hasta ?? '—' }}"
                            readonly
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label-custom">Fecha de Creación</label>
                        <input
                            type="text"
                            class="form-control-custom"
                            value="{{ $usuario->created_at ?? '—' }}"
                            readonly
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label-custom">Última Actualización</label>
                        <input
                            type="text"
                            class="form-control-custom"
                            value="{{ $usuario->updated_at ?? '—' }}"
                            readonly
                        >
                    </div>

                </div>
            </div>
        </div>
        @endif

        {{-- BOTONERA --}}
        <div class="form-actions mb-2">
            <a href="{{ route('usuarios.index') }}" class="btn-cancel-custom">
                Cancelar
            </a>
            <button type="submit" class="btn-create-custom">
                <i class="fa fa-floppy-disk me-2"></i>
                {{ $isEdit ? 'Actualizar Usuario' : 'Guardar Usuario' }}
            </button>
        </div>

    </form>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
@endpush