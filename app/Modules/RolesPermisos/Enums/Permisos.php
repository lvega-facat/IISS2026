<?php

namespace App\Modules\RolesPermisos\Enums;

/**
 * Enum de permisos del sistema
 * 
 * Formato: modulo.accion
 * - Los módulos corresponden a los slugs definidos en DatabaseSeeder
 * - Las acciones pueden ser: ver, crear, editar, eliminar (básicas)
 * - Además de acciones especiales: registrar, reporte, aprobar, generar, cerrar
 */
class Permisos
{
    // ==================== DASHBOARD ====================
    /** Ver dashboard principal */
    const DASHBOARD_VER = 'dashboard.ver';
    const DASHBOARD_CREAR = 'dashboard.crear';
    const DASHBOARD_EDITAR = 'dashboard.editar';
    const DASHBOARD_ELIMINAR = 'dashboard.eliminar';

    // ==================== ORGANIZACIÓN ====================
    /** Ver información de la organización */
    const ORGANIZACION_VER = 'organizacion.ver';
    /** Crear/registrar organización */
    const ORGANIZACION_CREAR = 'organizacion.crear';
    /** Editar organización */
    const ORGANIZACION_EDITAR = 'organizacion.editar';
    /** Eliminar organización */
    const ORGANIZACION_ELIMINAR = 'organizacion.eliminar';

    // ==================== DEPARTAMENTOS ====================
    /** Ver departamentos */
    const DEPARTAMENTOS_VER = 'departamentos.ver';
    /** Crear departamento */
    const DEPARTAMENTOS_CREAR = 'departamentos.crear';
    /** Editar departamento */
    const DEPARTAMENTOS_EDITAR = 'departamentos.editar';
    /** Eliminar departamento */
    const DEPARTAMENTOS_ELIMINAR = 'departamentos.eliminar';

    // ==================== CARGOS ====================
    /** Ver cargos */
    const CARGOS_VER = 'cargos.ver';
    /** Crear cargo */
    const CARGOS_CREAR = 'cargos.crear';
    /** Editar cargo */
    const CARGOS_EDITAR = 'cargos.editar';
    /** Eliminar cargo */
    const CARGOS_ELIMINAR = 'cargos.eliminar';

    // ==================== EMPLEADOS ====================
    /** Ver empleados */
    const EMPLEADOS_VER = 'empleados.ver';
    /** Crear empleado */
    const EMPLEADOS_CREAR = 'empleados.crear';
    /** Editar empleado */
    const EMPLEADOS_EDITAR = 'empleados.editar';
    /** Eliminar empleado */
    const EMPLEADOS_ELIMINAR = 'empleados.eliminar';

    // ==================== CONTRATOS ====================
    /** Ver contratos */
    const CONTRATOS_VER = 'contratos.ver';
    /** Crear contrato */
    const CONTRATOS_CREAR = 'contratos.crear';
    /** Editar contrato */
    const CONTRATOS_EDITAR = 'contratos.editar';
    /** Eliminar contrato */
    const CONTRATOS_ELIMINAR = 'contratos.eliminar';

    // ==================== ASISTENCIA ====================
    /** Ver asistencia */
    const ASISTENCIA_VER = 'asistencia.ver';
    /** Crear registro de asistencia */
    const ASISTENCIA_CREAR = 'asistencia.crear';
    /** Editar asistencia */
    const ASISTENCIA_EDITAR = 'asistencia.editar';
    /** Eliminar asistencia */
    const ASISTENCIA_ELIMINAR = 'asistencia.eliminar';
    /** Registrar asistencia (marcar entrada/salida) */
    const ASISTENCIA_REGISTRAR = 'asistencia.registrar';
    /** Ver reportes de asistencia */
    const ASISTENCIA_REPORTE = 'asistencia.reporte';

    // ==================== JUSTIFICATIVOS ====================
    /** Ver justificativos */
    const JUSTIFICATIVOS_VER = 'justificativos.ver';
    /** Crear justificativo */
    const JUSTIFICATIVOS_CREAR = 'justificativos.crear';
    /** Editar justificativo */
    const JUSTIFICATIVOS_EDITAR = 'justificativos.editar';
    /** Eliminar justificativo */
    const JUSTIFICATIVOS_ELIMINAR = 'justificativos.eliminar';
    /** Aprobar justificativo */
    const JUSTIFICATIVOS_APROBAR = 'justificativos.aprobar';

    // ==================== PLANILLAS ====================
    /** Ver planillas */
    const PLANILLAS_VER = 'planillas.ver';
    /** Crear planilla */
    const PLANILLAS_CREAR = 'planillas.crear';
    /** Editar planilla */
    const PLANILLAS_EDITAR = 'planillas.editar';
    /** Eliminar planilla */
    const PLANILLAS_ELIMINAR = 'planillas.eliminar';
    /** Generar planilla de pagos */
    const PLANILLAS_GENERAR = 'planillas.generar';
    /** Cerrar planilla (procesar pagos) */
    const PLANILLAS_CERRAR = 'planillas.cerrar';

    // ==================== ROLES Y PERMISOS ====================
    /** Ver roles y permisos */
    const ROLES_PERMISOS_VER = 'roles-permisos.ver';
    /** Crear rol */
    const ROLES_PERMISOS_CREAR = 'roles-permisos.crear';
    /** Editar rol */
    const ROLES_PERMISOS_EDITAR = 'roles-permisos.editar';
    /** Eliminar rol */
    const ROLES_PERMISOS_ELIMINAR = 'roles-permisos.eliminar';

    // ==================== USUARIOS ====================
    /** Ver usuarios del sistema */
    const USUARIOS_VER = 'usuarios.ver';
    /** Crear usuario */
    const USUARIOS_CREAR = 'usuarios.crear';
    /** Editar usuario */
    const USUARIOS_EDITAR = 'usuarios.editar';
    /** Eliminar usuario */
    const USUARIOS_ELIMINAR = 'usuarios.eliminar';

    // ==================== AUDITORÍA ====================
    /** Ver logs de auditoría */
    const AUDITORIA_VER = 'auditoria.ver';
    /** Crear registro de auditoría */
    const AUDITORIA_CREAR = 'auditoria.crear';
    /** Editar registro de auditoría */
    const AUDITORIA_EDITAR = 'auditoria.editar';
    /** Eliminar registro de auditoría */
    const AUDITORIA_ELIMINAR = 'auditoria.eliminar';

    /**
     * Obtener todos los permisos como array
     * 
     * @return array
     */
    public static function all(): array
    {
        $reflection = new \ReflectionClass(self::class);
        return array_values($reflection->getConstants());
    }

    /**
     * Obtener permisos por módulo
     * 
     * @param string $moduloSlug
     * @return array
     */
    public static function getByModulo(string $moduloSlug): array
    {
        $permisos = [];
        foreach (self::all() as $permiso) {
            if (str_starts_with($permiso, $moduloSlug . '.')) {
                $permisos[] = $permiso;
            }
        }
        return $permisos;
    }

    /**
     * Verificar si un permiso existe en el enum
     * 
     * @param string $permiso
     * @return bool
     */
    public static function exists(string $permiso): bool
    {
        return in_array($permiso, self::all());
    }

    /**
     * Obtener solo las acciones básicas de un módulo
     * 
     * @param string $moduloSlug
     * @return array
     */
    public static function getAccionesBasicas(string $moduloSlug): array
    {
        $basicas = ['ver', 'crear', 'editar', 'eliminar'];
        $permisos = [];
        
        foreach ($basicas as $accion) {
            $permiso = $moduloSlug . '.' . $accion;
            if (self::exists($permiso)) {
                $permisos[] = $permiso;
            }
        }
        
        return $permisos;
    }

    /**
     * Obtener módulo a partir de un permiso
     * 
     * @param string $permiso
     * @return string
     */
    public static function getModulo(string $permiso): string
    {
        return explode('.', $permiso)[0];
    }

    /**
     * Obtener acción a partir de un permiso
     * 
     * @param string $permiso
     * @return string
     */
    public static function getAccion(string $permiso): string
    {
        $parts = explode('.', $permiso);
        return $parts[1] ?? '';
    }
}