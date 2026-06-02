@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>Bienvenido al dashboard de tu aplicación Laravel.</p>
    </div>
    <div class="info-usuario">
        <h1>Información del Usuario</h1>
        @foreach($viewModel->getTodosLosUsuarios($usuarios) as $usuarioInfo)

            <p>Nombre: {{ $usuarioInfo['nombre'] }}</p>
        @endforeach
    </div>
@endsection
