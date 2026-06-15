<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Clear existing data (optional but ensures clean state)
        $tables = [
            'auditoria_log',
            'cambios_permisos',
            'justificativos',
            'asistencias',
            'planilla_detalles',
            'planillas',
            'contratos',
            'sesiones',
            'usuarios',
            'empleados',
            'cargos',
            'departamento_dependiente',
            'departamentos',
            'tipos_contrato',
            'horarios_trabajo',
            'profesiones',
            'rol_permiso',
            'permisos',
            'modulos',
            'roles',
            'tipos_pago',
            'frecuencias_pago',
            'cat_estados_asistencia',
            'organizaciones',
            'users'
        ];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }


        // -------------------- 1. ORGANIZACIÓN --------------------
        $orgId = DB::table('organizaciones')->insertGetId([
            'nombre' => 'Empresa Demo S.A.C.',
            'ruc' => '20512345678',
            'fecha_registro' => '2020-01-01',
            'direccion' => 'Av. Principal 123, Lima, Perú',
            'pais' => 'Perú',
            'email' => 'info@empresademo.com',
            'telefono' => '+51 1 987654321',
            'sector' => 'Tecnología',
            'logo_url' => 'https://example.com/logo.png',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // -------------------- 2. MÓDULOS --------------------
        $modulos = [
            ['nombre' => 'Dashboard', 'slug' => 'dashboard'],
            ['nombre' => 'Organización', 'slug' => 'organizacion'],
            ['nombre' => 'Departamentos', 'slug' => 'departamentos'],
            ['nombre' => 'Cargos', 'slug' => 'cargos'],
            ['nombre' => 'Empleados', 'slug' => 'empleados'],
            ['nombre' => 'Contratos', 'slug' => 'contratos'],
            ['nombre' => 'Asistencia', 'slug' => 'asistencia'],
            ['nombre' => 'Justificativos', 'slug' => 'justificativos'],
            ['nombre' => 'Planillas', 'slug' => 'planillas'],
            ['nombre' => 'Roles y Permisos', 'slug' => 'roles-permisos'],
            ['nombre' => 'Usuarios', 'slug' => 'usuarios'],
            ['nombre' => 'Auditoría', 'slug' => 'auditoria'],
        ];
        $moduloIds = [];
        foreach ($modulos as $modulo) {
            $moduloIds[$modulo['slug']] = DB::table('modulos')->insertGetId($modulo);
        }

        // -------------------- 3. PERMISOS (acciones por módulo) --------------------
        $acciones = ['ver', 'crear', 'editar', 'eliminar'];
        // Permisos especiales para algunos módulos
        $permisosData = [];
        foreach ($moduloIds as $slug => $mid) {
            foreach ($acciones as $accion) {
                $permisosData[] = ['id_modulo' => $mid, 'accion' => $accion];
            }
        }
        // Añadir permisos extra para Asistencia: registrar, reporte
        $asistenciaId = $moduloIds['asistencia'];
        $permisosData[] = ['id_modulo' => $asistenciaId, 'accion' => 'registrar'];
        $permisosData[] = ['id_modulo' => $asistenciaId, 'accion' => 'reporte'];
        // Para Justificativos: aprobar
        $justifId = $moduloIds['justificativos'];
        $permisosData[] = ['id_modulo' => $justifId, 'accion' => 'aprobar'];
        // Para Planillas: generar, cerrar
        $planillaId = $moduloIds['planillas'];
        $permisosData[] = ['id_modulo' => $planillaId, 'accion' => 'generar'];
        $permisosData[] = ['id_modulo' => $planillaId, 'accion' => 'cerrar'];

        $permisoIds = [];
        foreach ($permisosData as $perm) {
            $permisoIds[] = DB::table('permisos')->insertGetId($perm);
        }

        // -------------------- 4. ROLES --------------------
        $adminRolId = DB::table('roles')->insertGetId([
            'nombre' => 'Administrador',
            'descripcion' => 'Acceso total al sistema',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $managerRolId = DB::table('roles')->insertGetId([
            'nombre' => 'Gerente',
            'descripcion' => 'Gestión de personal, planillas y asistencia',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $empleadoRolId = DB::table('roles')->insertGetId([
            'nombre' => 'Empleado',
            'descripcion' => 'Acceso limitado: ver sus datos y registrar asistencia',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asignar TODOS los permisos al rol Administrador
        foreach ($permisoIds as $pid) {
            DB::table('rol_permiso')->insert([
                'id_rol' => $adminRolId,
                'id_permiso' => $pid,
            ]);
        }

        // Asignar permisos específicos al rol Gerente
        $gerentePerms = [
            'dashboard' => ['ver'],
            'departamentos' => ['ver', 'crear', 'editar'],
            'cargos' => ['ver', 'crear', 'editar'],
            'empleados' => ['ver', 'crear', 'editar'],
            'contratos' => ['ver', 'crear', 'editar'],
            'asistencia' => ['ver', 'registrar', 'reporte'],
            'justificativos' => ['ver', 'aprobar'],
            'planillas' => ['ver', 'generar', 'cerrar'],
        ];
        foreach ($gerentePerms as $slug => $acciones) {
            $mid = $moduloIds[$slug];
            foreach ($acciones as $accion) {
                $permiso = DB::table('permisos')->where('id_modulo', $mid)->where('accion', $accion)->first();
                if ($permiso) {
                    DB::table('rol_permiso')->insert([
                        'id_rol' => $managerRolId,
                        'id_permiso' => $permiso->id,
                    ]);
                }
            }
        }

        // Asignar permisos al rol Empleado (solo ver su perfil y registrar asistencia)
        $empleadoPerms = [
            'dashboard' => ['ver'],
            'empleados' => ['ver'],     // solo su propio perfil (controlado por lógica)
            'asistencia' => ['registrar', 'ver'],
            'justificativos' => ['ver', 'crear'],
        ];
        foreach ($empleadoPerms as $slug => $acciones) {
            $mid = $moduloIds[$slug];
            foreach ($acciones as $accion) {
                $permiso = DB::table('permisos')->where('id_modulo', $mid)->where('accion', $accion)->first();
                if ($permiso) {
                    DB::table('rol_permiso')->insert([
                        'id_rol' => $empleadoRolId,
                        'id_permiso' => $permiso->id,
                    ]);
                }
            }
        }

        // -------------------- 5. PROFESIONES --------------------
        $profesiones = [
            ['nombre' => 'Ingeniería de Software', 'descripcion' => 'Desarrollo y mantenimiento de software'],
            ['nombre' => 'Administración de Empresas', 'descripcion' => 'Gestión administrativa'],
            ['nombre' => 'Contabilidad', 'descripcion' => 'Gestión financiera y contable'],
            ['nombre' => 'Recursos Humanos', 'descripcion' => 'Gestión de talento humano'],
        ];
        $profesionIds = [];
        foreach ($profesiones as $prof) {
            $profesionIds[] = DB::table('profesiones')->insertGetId(array_merge($prof, [
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // -------------------- 6. HORARIOS DE TRABAJO --------------------
        $horarios = [
            [
                'nombre' => 'Jornada Regular 9-6',
                'descripcion' => 'Lunes a viernes 9:00 a 18:00',
                'tipo_jornada' => 'completa',
                'hora_entrada' => '09:00:00',
                'hora_salida' => '18:00:00',
                'horas_diarias' => 8.00,
                'horas_semanales' => 40.00,
                'tolerancia_minutos' => 15,
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Media Jornada 9-1',
                'descripcion' => 'Lunes a viernes 9:00 a 13:00',
                'tipo_jornada' => 'media',
                'hora_entrada' => '09:00:00',
                'hora_salida' => '13:00:00',
                'horas_diarias' => 4.00,
                'horas_semanales' => 20.00,
                'tolerancia_minutos' => 10,
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        $horarioIds = [];
        foreach ($horarios as $hor) {
            $horarioIds[] = DB::table('horarios_trabajo')->insertGetId($hor);
        }

        // -------------------- 7. TIPOS DE PAGO --------------------
        $tiposPago = [
            ['nombre' => 'Mensual', 'codigo' => 'MEN', 'descripcion' => 'Pago por mes completo', 'estado' => true, 'unidad_calculo' => 'salario'],
            ['nombre' => 'Quincenal', 'codigo' => 'QUI', 'descripcion' => 'Pago por quincena', 'estado' => true, 'unidad_calculo' => 'dia'],
            ['nombre' => 'Semanal', 'codigo' => 'SEM', 'descripcion' => 'Pago por semana', 'estado' => true, 'unidad_calculo' => 'dia'],
        ];
        $tipoPagoIds = [];
        foreach ($tiposPago as $tp) {
            $tipoPagoIds[] = DB::table('tipos_pago')->insertGetId(array_merge($tp, ['created_at' => now()]));
        }

        // -------------------- 8. FRECUENCIAS DE PAGO --------------------
        $frecuencias = [
            ['nombre' => 'Mensual', 'dias' => 30, 'estado' => true],
            ['nombre' => 'Quincenal', 'dias' => 15, 'estado' => true],
            ['nombre' => 'Semanal', 'dias' => 7, 'estado' => true],
        ];
        $frecuenciaIds = [];
        foreach ($frecuencias as $freq) {
            $frecuenciaIds[] = DB::table('frecuencias_pago')->insertGetId(array_merge($freq, ['created_at' => now()]));
        }

        // -------------------- 9. DEPARTAMENTOS --------------------
        $departamentos = [
            ['nombre' => 'Gerencia General', 'codigo' => 'GG', 'funcion_principal' => 'Dirección estratégica', 'estado' => true],
            ['nombre' => 'Tecnología', 'codigo' => 'TEC', 'funcion_principal' => 'Desarrollo de software e infraestructura TI', 'estado' => true],
            ['nombre' => 'Recursos Humanos', 'codigo' => 'RRHH', 'funcion_principal' => 'Gestión del talento', 'estado' => true],
            ['nombre' => 'Finanzas', 'codigo' => 'FIN', 'funcion_principal' => 'Gestión contable y financiera', 'estado' => true],
        ];
        $departamentoIds = [];
        foreach ($departamentos as $dep) {
            $departamentoIds[] = DB::table('departamentos')->insertGetId(array_merge($dep, [
                'id_organizacion' => $orgId,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
        // Relación de dependencias: RRHH depende de Gerencia General, Finanzas depende de Gerencia General
        DB::table('departamento_dependiente')->insert([
            ['id_departamento_padre' => $departamentoIds[0], 'id_departamento_hijo' => $departamentoIds[2], 'tipo_dependencia' => 'funcional'],
            ['id_departamento_padre' => $departamentoIds[0], 'id_departamento_hijo' => $departamentoIds[3], 'tipo_dependencia' => 'funcional'],
        ]);

        // -------------------- 10. CARGOS (con jerarquía padre-hijo) --------------------
        // Gerente General
        $gerenteGeneralId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[0],
            'id_cargo_padre' => null,
            'nombre' => 'Gerente General',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Jefe de Tecnología
        $jefeTecId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[1],
            'id_cargo_padre' => $gerenteGeneralId,
            'nombre' => 'Jefe de Tecnología',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Desarrollador Senior (depende de Jefe Tecnología)
        $desarrolladorId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[1],
            'id_cargo_padre' => $jefeTecId,
            'nombre' => 'Desarrollador Senior',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Jefe de RRHH
        $jefeRrhhId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[2],
            'id_cargo_padre' => $gerenteGeneralId,
            'nombre' => 'Jefe de Recursos Humanos',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Analista de RRHH
        $analistaRrhhId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[2],
            'id_cargo_padre' => $jefeRrhhId,
            'nombre' => 'Analista de RRHH',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Jefe de Finanzas
        $jefeFinanzasId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[3],
            'id_cargo_padre' => $gerenteGeneralId,
            'nombre' => 'Jefe de Finanzas',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Contador
        $contadorId = DB::table('cargos')->insertGetId([
            'id_departamento' => $departamentoIds[3],
            'id_cargo_padre' => $jefeFinanzasId,
            'nombre' => 'Contador General',
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cargos = [
            'gerente_general' => $gerenteGeneralId,
            'jefe_tecnologia' => $jefeTecId,
            'desarrollador' => $desarrolladorId,
            'jefe_rrhh' => $jefeRrhhId,
            'analista_rrhh' => $analistaRrhhId,
            'jefe_finanzas' => $jefeFinanzasId,
            'contador' => $contadorId,
        ];

        // -------------------- 11. EMPLEADOS --------------------
        $empleados = [
            [
                'nombre' => 'Ana',
                'apellido' => 'García',
                'email' => 'ana.garcia@empresademo.com',
                'dni_ci' => '12345678',
                'telefono' => '987654321',
                'tipo_trabajo' => 'tiempo_completo',
                'descripcion' => 'Gerente General',
                'foto_url' => null,
                'estado' => true,
                'id_departamento' => $departamentoIds[0],
                'id_cargo' => $cargos['gerente_general'],
                'id_profesion' => $profesionIds[1],
                'fecha_registro' => '2021-01-10'
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Lopez',
                'email' => 'carlos.lopez@empresademo.com',
                'dni_ci' => '87654321',
                'telefono' => '912345678',
                'tipo_trabajo' => 'tiempo_completo',
                'descripcion' => 'Jefe de Tecnología',
                'foto_url' => null,
                'estado' => true,
                'id_departamento' => $departamentoIds[1],
                'id_cargo' => $cargos['jefe_tecnologia'],
                'id_profesion' => $profesionIds[0],
                'fecha_registro' => '2021-03-15'
            ],
            [
                'nombre' => 'María',
                'apellido' => 'Rodríguez',
                'email' => 'maria.rodriguez@empresademo.com',
                'dni_ci' => '11223344',
                'telefono' => '998877665',
                'tipo_trabajo' => 'tiempo_completo',
                'descripcion' => 'Desarrolladora Senior',
                'foto_url' => null,
                'estado' => true,
                'id_departamento' => $departamentoIds[1],
                'id_cargo' => $cargos['desarrollador'],
                'id_profesion' => $profesionIds[0],
                'fecha_registro' => '2021-06-20'
            ],
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'email' => 'juan.perez@empresademo.com',
                'dni_ci' => '55667788',
                'telefono' => '955443322',
                'tipo_trabajo' => 'tiempo_completo',
                'descripcion' => 'Analista de RRHH',
                'foto_url' => null,
                'estado' => true,
                'id_departamento' => $departamentoIds[2],
                'id_cargo' => $cargos['analista_rrhh'],
                'id_profesion' => $profesionIds[3],
                'fecha_registro' => '2022-02-01'
            ],
            [
                'nombre' => 'Luisa',
                'apellido' => 'Fernández',
                'email' => 'luisa.fernandez@empresademo.com',
                'dni_ci' => '99887766',
                'telefono' => '966332211',
                'tipo_trabajo' => 'tiempo_completo',
                'descripcion' => 'Contadora',
                'foto_url' => null,
                'estado' => true,
                'id_departamento' => $departamentoIds[3],
                'id_cargo' => $cargos['contador'],
                'id_profesion' => $profesionIds[2],
                'fecha_registro' => '2022-05-10'
            ],
        ];
        $empleadoIds = [];
        foreach ($empleados as $emp) {
            $fechaReg = $emp['fecha_registro'];
            unset($emp['fecha_registro']);
            $empleadoIds[] = DB::table('empleados')->insertGetId(array_merge($emp, [
                'fecha_registro' => $fechaReg,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // -------------------- 12. USUARIOS DEL SISTEMA (vinculados a empleados) --------------------
        // Administrador (no vinculado a empleado)
        $adminUser = DB::table('usuarios')->insertGetId([
            'id_empleado' => null,
            'id_rol' => $adminRolId,
            'id_organizacion' => $orgId,
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@empresademo.com',
            'password_hash' => Hash::make('admin123'),
            'foto_url' => null,
            'estado' => true,
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Gerente (vinculado a Ana García)
        $gerenteUser = DB::table('usuarios')->insertGetId([
            'id_empleado' => $empleadoIds[0],
            'id_rol' => $managerRolId,
            'id_organizacion' => $orgId,
            'nombre' => 'Ana',
            'apellido' => 'García',
            'email' => 'ana.garcia@empresademo.com',
            'password_hash' => Hash::make('gerente123'),
            'foto_url' => null,
            'estado' => true,
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Empleado (María Rodríguez)
        $empleadoUser = DB::table('usuarios')->insertGetId([
            'id_empleado' => $empleadoIds[2],
            'id_rol' => $empleadoRolId,
            'id_organizacion' => $orgId,
            'nombre' => 'María',
            'apellido' => 'Rodríguez',
            'email' => 'maria.rodriguez@empresademo.com',
            'password_hash' => Hash::make('empleado123'),
            'foto_url' => null,
            'estado' => true,
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
            'ultimo_acceso' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // -------------------- 13. TIPOS DE CONTRATO --------------------
        $tiposContrato = [
            [
                'nombre' => 'Planilla Indefinido - TI',
                'descripcion' => 'Contrato a plazo indeterminado para área tecnología',
                'id_profesion' => $profesionIds[0],
                'id_horario' => $horarioIds[0],
                'estado' => true
            ],
            [
                'nombre' => 'Planilla Indefinido - Administrativo',
                'descripcion' => 'Contrato administrativo general',
                'id_profesion' => $profesionIds[1],
                'id_horario' => $horarioIds[0],
                'estado' => true
            ],
            [
                'nombre' => 'Media Jornada - RRHH',
                'descripcion' => 'Contrato media jornada para RRHH',
                'id_profesion' => $profesionIds[3],
                'id_horario' => $horarioIds[1],
                'estado' => true
            ],
        ];
        $tipoContratoIds = [];
        foreach ($tiposContrato as $tc) {
            $tipoContratoIds[] = DB::table('tipos_contrato')->insertGetId(array_merge($tc, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // -------------------- 14. CONTRATOS DE EMPLEADOS --------------------
        $contratos = [
            ['id_empleado' => $empleadoIds[0], 'id_tipo_contrato' => $tipoContratoIds[1], 'monto_base' => 8000.00, 'fecha_inicio' => '2021-01-10', 'id_tipo_pago' => $tipoPagoIds[0], 'id_frecuencia_pago' => $frecuenciaIds[0], 'fecha_fin' => null, 'estado' => true],
            ['id_empleado' => $empleadoIds[1], 'id_tipo_contrato' => $tipoContratoIds[0], 'monto_base' => 7000.00, 'fecha_inicio' => '2021-03-15', 'id_tipo_pago' => $tipoPagoIds[0], 'id_frecuencia_pago' => $frecuenciaIds[0], 'fecha_fin' => null, 'estado' => true],
            ['id_empleado' => $empleadoIds[2], 'id_tipo_contrato' => $tipoContratoIds[0], 'monto_base' => 5000.00, 'fecha_inicio' => '2021-06-20', 'id_tipo_pago' => $tipoPagoIds[0], 'id_frecuencia_pago' => $frecuenciaIds[0], 'fecha_fin' => null, 'estado' => true],
            ['id_empleado' => $empleadoIds[3], 'id_tipo_contrato' => $tipoContratoIds[2], 'monto_base' => 3500.00, 'fecha_inicio' => '2022-02-01', 'id_tipo_pago' => $tipoPagoIds[0], 'id_frecuencia_pago' => $frecuenciaIds[0], 'fecha_fin' => null, 'estado' => true],
            ['id_empleado' => $empleadoIds[4], 'id_tipo_contrato' => $tipoContratoIds[1], 'monto_base' => 4500.00, 'fecha_inicio' => '2022-05-10', 'id_tipo_pago' => $tipoPagoIds[0], 'id_frecuencia_pago' => $frecuenciaIds[0], 'fecha_fin' => null, 'estado' => true],
        ];
        $contratoIds = [];
        foreach ($contratos as $cont) {
            $contratoIds[] = DB::table('contratos')->insertGetId(array_merge($cont, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // -------------------- 15. CATÁLOGO ESTADOS ASISTENCIA --------------------
        $estadosAsistencia = ['Presente', 'Ausente', 'Tardanza', 'Permiso', 'Vacaciones','Justificado'];
        $estadoAsistenciaIds = [];
        foreach ($estadosAsistencia as $est) {
            $estadoAsistenciaIds[$est] = DB::table('cat_estados_asistencia')->insertGetId(['nombre' => $est]);
        }

        // -------------------- 16. ASISTENCIAS (últimos 10 días) --------------------
        $fechas = [];
        for ($i = 0; $i < 10; $i++) {
            $fechas[] = Carbon::now()->subDays($i)->toDateString();
        }

        foreach ($empleadoIds as $empId) {
            // Obtener contrato activo del empleado (el primero)
            $contrato = DB::table('contratos')->where('id_empleado', $empId)->where('estado', true)->first();
            if (!$contrato) continue;

            foreach ($fechas as $fecha) {
                $estado = rand(1, 10) <= 7 ? 'Presente' : (rand(1, 10) <= 2 ? 'Tardanza' : 'Ausente');
                $horaEntrada = ($estado == 'Presente') ? '09:05:00' : (($estado == 'Tardanza') ? '09:20:00' : null);
                $minutosTardanza = ($estado == 'Tardanza') ? 20 : 0;
                $horaSalida = ($estado == 'Presente' || $estado == 'Tardanza') ? '18:00:00' : null;
                $horasTrabajadas = ($estado == 'Presente' || $estado == 'Tardanza') ? 8.0 : 0;

                DB::table('asistencias')->insert([
                    'id_empleado' => $empId,
                    'id_contrato' => $contrato->id,
                    'id_estado_asistencia' => $estadoAsistenciaIds[$estado],
                    'fecha_entrada' => $fecha,
                    'hora_entrada' => $horaEntrada,
                    'hora_salida' => $horaSalida,
                    'minutos_tardanza' => $minutosTardanza,
                    'horas_trabajadas' => $horasTrabajadas,
                    'horas_extra' => 0,
                    'horas_ausentes' => ($estado == 'Ausente') ? 8 : 0,
                    'tiene_justificativo' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Agregar algunas tardanzas con justificativo pendiente
        $asistenciasTardanza = DB::table('asistencias')->where('minutos_tardanza', '>', 0)->limit(2)->get();
        foreach ($asistenciasTardanza as $asis) {
            DB::table('justificativos')->insert([
                'id_asistencia' => $asis->id,
                'id_aprobador' => null,
                'tipo_justificativo' => 'Tardanza por tráfico',
                'descripcion' => 'Problemas de transporte público',
                'archivo_url' => null,
                'estado_aprobacion' => 'Pendiente',
                'fecha_aprobacion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Actualizar flag tiene_justificativo
            DB::table('asistencias')->where('id', $asis->id)->update(['tiene_justificativo' => true]);
        }

        // -------------------- 17. PLANILLA para período del mes anterior --------------------
        $periodoInicio = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $periodoFin = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $planillaId = DB::table('planillas')->insertGetId([
            'id_organizacion' => $orgId,
            'periodo_inicio' => $periodoInicio,
            'periodo_fin' => $periodoFin,
            'estado' => 'Cerrada',
            'generado_por' => $adminUser,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($empleadoIds as $empId) {
            $contrato = DB::table('contratos')->where('id_empleado', $empId)->where('estado', true)->first();
            if (!$contrato) continue;

            $salarioBase = $contrato->monto_base;
            $horasTrabajadas = 160; // aproximado
            $horasExtra = 5;
            $montoHorasExtra = $horasExtra * (($salarioBase / 240) * 1.5);
            $bonos = 200;
            $descuentos = 50;
            $totalBruto = $salarioBase + $montoHorasExtra + $bonos;
            $totalPagar = $totalBruto - $descuentos;

            DB::table('planilla_detalles')->insert([
                'id_planilla' => $planillaId,
                'id_empleado' => $empId,
                'id_contrato' => $contrato->id,
                'salario_base_aplicado' => $salarioBase,
                'horas_trabajadas' => $horasTrabajadas,
                'horas_extra' => $horasExtra,
                'total_horas_extra_monto' => $montoHorasExtra,
                'bonos' => $bonos,
                'descuentos' => $descuentos,
                'total_bruto' => $totalBruto,
                'total_pagar' => $totalPagar,
                'estado_pago' => 'Pagado',
                'unidad_calculo_aplicada' => 'mes',
                'frecuencia_dias_aplicada' => 30,
                'horas_diarias_aplicadas' => 8,
                'created_at' => now(),
            ]);
        }

        // -------------------- 18. REGISTROS DE AUDITORÍA --------------------
        DB::table('auditoria_log')->insert([
            [
                'id_usuario' => $adminUser,
                'modulo' => 'Usuarios',
                'accion' => 'Crear',
                'valor_anterior' => null,
                'valor_nuevo' => json_encode(['email' => 'admin@empresademo.com', 'rol' => 'Administrador']),
                'ip_origen' => '127.0.0.1',
                'ruta' => '/admin/usuarios',
                'timestamp' => now(),
            ],
            [
                'id_usuario' => $gerenteUser,
                'modulo' => 'Planillas',
                'accion' => 'Generar',
                'valor_anterior' => null,
                'valor_nuevo' => json_encode(['periodo' => $periodoInicio . ' - ' . $periodoFin]),
                'ip_origen' => '192.168.1.100',
                'ruta' => '/planillas/generar',
                'timestamp' => now()->subDays(5),
            ],
            [
                'id_usuario' => $empleadoUser,
                'modulo' => 'Asistencia',
                'accion' => 'Registrar',
                'valor_anterior' => null,
                'valor_nuevo' => json_encode(['fecha' => now()->toDateString(), 'hora' => '09:05']),
                'ip_origen' => '192.168.1.50',
                'ruta' => '/asistencia/registrar',
                'timestamp' => now()->subDays(1),
            ],
        ]);

        // -------------------- 19. ADICIONAL: SESSIONES (opcional) --------------------
        // En DatabaseSeeder.php, línea ~632
        DB::table('sessions')->insert([
            'id' => 'test_session_' . uniqid(),  // ← Dinámico
            'user_id' => $adminUser,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Seeder)',
            'payload' => base64_encode(json_encode(['_token' => 'test'])),
            'last_activity' => time(),
        ]);

        // -------------------- 20. CAMBIOS PERMISOS (auditoría adicional) --------------------
        DB::table('cambios_permisos')->insert([
            'id_usuario' => $adminUser,
            'id_rol' => $managerRolId,
            'id_modulo' => $moduloIds['planillas'],
            'accion' => 'grant_generar',
            'timestamp' => now(),
        ]);

        $this->command->info('Seeder ejecutado correctamente. Datos de prueba insertados.');
    }
}
