
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HumanCore - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    @stack('styles')
</head>
<body>
<div class="wrapper">

    <!-- =========================================
         SIDEBAR
    ========================================== -->
    <nav id="sidebar">

        <div class="sidebar-header">
            <button id="sidebarToggle" class="sidebar-toggle">
                <i class="fa fa-minus"></i>
            </button>

            <h3>HumanCore</h3>
        </div>

        <ul class="list-unstyled components" id="sidebarMenu">

            <!-- Dashboard -->
            <li>
                <a href="#dashboard" class="nav-link-custom no-submenu selected-active">
                    <i class="fa fa-info-circle me-2"></i>
                    Dashboard
                </a>
            </li>

            <!-- Configuración Organizacional -->
            <li>
                <a href="#configOrgSubmenu"
                   class="nav-link-custom dropdown-toggle"
                   data-bs-toggle="collapse"
                   aria-expanded="false">

                    <i class="fa fa-sitemap me-2"></i>
                    Config. Organizacional
                </a>

                <ul class="collapse list-unstyled submenu"
                    id="configOrgSubmenu"
                    data-bs-parent="#sidebarMenu">

                    <li><a href="#organizacion">Organización</a></li>
                    <li><a href="#departamentos">Departamentos</a></li>
                    <li><a href="#cargos">Cargos</a></li>
                </ul>
            </li>

            <!-- Gestión de Personal -->
            <li>
                <a href="#gestionPersonalSubmenu"
                   class="nav-link-custom dropdown-toggle"
                   data-bs-toggle="collapse"
                   aria-expanded="false">

                    <i class="fa fa-users me-2"></i>
                    Gestión de Personal
                </a>

                <ul class="collapse list-unstyled submenu"
                    id="gestionPersonalSubmenu"
                    data-bs-parent="#sidebarMenu">

                    <li><a href="#empleados">Empleados</a></li>
                    <li><a href="#justificativos">Justificativos</a></li>
                </ul>
            </li>

            <!-- Configuración de Contratos -->
            <li>
                <a href="#configContratosSubmenu"
                   class="nav-link-custom dropdown-toggle"
                   data-bs-toggle="collapse"
                   aria-expanded="false">

                    <i class="fa fa-file-text me-2"></i>
                    Contratos
                </a>

                <ul class="collapse list-unstyled submenu"
                    id="configContratosSubmenu"
                    data-bs-parent="#sidebarMenu">

                    <li><a href="#Profesiones">Profesiones</a></li>
                    <li><a href="#Horarios">Horarios</a></li>
                    <li><a href="#tiposdepago">Tipos de Pago</a></li>
                    <li><a href="#frecuencias">Frecuencias</a></li>
                    <li><a href="#tiposDeContrado">Tipos de Contrato</a></li>

                </ul>
            </li>

            <!-- Control de Asistencia -->
            <li>
                <a href="#asistenciaSubmenu"
                   class="nav-link-custom dropdown-toggle"
                   data-bs-toggle="collapse"
                   aria-expanded="false">

                    <i class="fa fa-calendar-check-o me-2"></i>
                    Control de Asistencia
                </a>

                <ul class="collapse list-unstyled submenu"
                    id="asistenciaSubmenu"
                    data-bs-parent="#sidebarMenu">

                    <li><a href="#asistencias">Asistencias</a></li>
                    <li><a href="#planillas">Planillas</a></li>
                </ul>
            </li>

            <!-- Seguridad y Acceso -->
            <li>
                <a href="#seguridadSubmenu"
                   class="nav-link-custom dropdown-toggle"
                   data-bs-toggle="collapse"
                   aria-expanded="false">

                    <i class="fa fa-lock me-2"></i>
                    Seguridad y Acceso
                </a>

                <ul class="collapse list-unstyled submenu"
                    id="seguridadSubmenu"
                    data-bs-parent="#sidebarMenu">

                    <li><a href="#autenticacion">Autenticación</a></li>
                    <li><a href="#usuarios">Usuarios</a></li>
                    <li><a href="#rolesPermisos">Roles y Permisos</a></li>
                </ul>
            </li>

            <!-- Monitoreo y Auditoría -->
            <li>
                <a href="#auditoria" class="nav-link-custom no-submenu">
                    <i class="fa fa-file-text-o me-2"></i>
                    Auditoría
                </a>
            </li>

        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        © 2026
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
