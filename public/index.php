<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\BoletasPagoController;
use Controllers\DashboardController;

use Controllers\PaginasController;

use Controllers\ColaboradoresController;
use Controllers\DashboardColController;
use Controllers\DepartamentosController;
use Controllers\EmpresasController;
use Controllers\IncapacidadesController;
use Controllers\ReservasController;
use Controllers\VacacionesController;

$router = new Router();


// Login ---correcto
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//Area de administracion ---correcto
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/colaboradores', [ColaboradoresController::class, 'index']);
$router->get('/admin/colaboradores/crear', [ColaboradoresController::class, 'registro']);
$router->post('/admin/colaboradores/crear', [ColaboradoresController::class, 'registro']);
$router->get('/admin/colaboradores/editar', [ColaboradoresController::class, 'editar']);
$router->post('/admin/colaboradores/editar', [ColaboradoresController::class, 'editar']);
$router->post('/admin/colaboradores/eliminar', [ColaboradoresController::class, 'eliminar']);
$router->get('/admin/colaboradores/observar', [ColaboradoresController::class, 'observar']);
$router->get('/admin/colaboradores/descargar-tabla-csv', [ColaboradoresController::class, 'descargar']);

$router->get('/admin/departamentos', [DepartamentosController::class, 'index']);
$router->get('/admin/departamentos/crear', [DepartamentosController::class, 'crear']);
$router->post('/admin/departamentos/crear', [DepartamentosController::class, 'crear']);
$router->get('/admin/departamentos/editar', [DepartamentosController::class, 'editar']);
$router->post('/admin/departamentos/editar', [DepartamentosController::class, 'editar']);
$router->post('/admin/departamentos/eliminar', [DepartamentosController::class, 'eliminar']);

$router->get('/admin/empresas', [EmpresasController::class, 'index']);
$router->get('/admin/empresas/crear', [EmpresasController::class, 'crear']);
$router->post('/admin/empresas/crear', [EmpresasController::class, 'crear']);
$router->get('/admin/empresas/editar', [EmpresasController::class, 'editar']);
$router->post('/admin/empresas/editar', [EmpresasController::class, 'editar']);
$router->post('/admin/empresas/eliminar', [EmpresasController::class, 'eliminar']);

$router->get('/admin/incapacidades', [IncapacidadesController::class, 'index']);
$router->get('/admin/incapacidades/observar', [IncapacidadesController::class, 'observar']);

$router->get('/admin/vacaciones', [VacacionesController::class, 'index']);
$router->get('/admin/vacaciones/editar', [VacacionesController::class, 'editar']);
$router->post('/admin/vacaciones/editar', [VacacionesController::class, 'editar']);

$router->get('/admin/boletaspagos', [BoletasPagoController::class, 'index']);
$router->get('/admin/boletaspagos/crear', [BoletasPagoController::class, 'crear']);
$router->post('/admin/boletaspagos/crear', [BoletasPagoController::class, 'crear']);

$router->get('/admin/boletaspagos/cargar', [BoletasPagoController::class, 'cargarDesdeCSV']);
$router->post('/admin/boletaspagos/cargar', [BoletasPagoController::class, 'cargarDesdeCSV']);


//Area publica
$router->get('/', [PaginasController::class, 'index']);
// $router->get('/devwebcamp', [PaginasController::class, 'evento']);
// $router->get('/paquetes', [PaginasController::class, 'paquetes']);
// $router->get('/workshops-conferencias', [PaginasController::class, 'conferencias']);
$router->get('/404', [PaginasController::class, 'error']);

//Area de Colaboradores ---correcto
$router->get('/colaborador/dashboard', [DashboardColController::class, 'index']);
$router->get('/colaborador/configuracion', [DashboardColController::class, 'indexConfig']);
$router->get('/colaborador/configuracion/editarinfo', [DashboardColController::class, 'editar']);
$router->post('/colaborador/configuracion/editarinfo', [DashboardColController::class, 'editar']);
$router->get('/colaborador/configuracion/cambiocontrasena', [DashboardColController::class, 'reestablecer']);
$router->post('/colaborador/configuracion/cambiocontrasena', [DashboardColController::class, 'reestablecer']);


$router->get('/colaborador/vacaciones', [VacacionesController::class, 'indexColaborador']);
$router->get('/colaborador/vacaciones/crear', [VacacionesController::class, 'crear']);
$router->post('/colaborador/vacaciones/crear', [VacacionesController::class, 'crear']);
$router->get('/colaborador/vacaciones/editar', [VacacionesController::class, 'editarColaborador']);
$router->post('/colaborador/vacaciones/editar', [VacacionesController::class, 'editarColaborador']);

$router->get('/colaborador/reservaciones', [ReservasController::class, 'index']);

$router->get('/colaborador/incapacidades', [IncapacidadesController::class, 'indexColaborador']);
$router->get('/colaborador/incapacidades/crear', [IncapacidadesController::class, 'crear']);
$router->post('/colaborador/incapacidades/crear', [IncapacidadesController::class, 'crear']);

$router->get('/colaborador/boletapago', [BoletasPagoController::class, 'indexColaborador']);


$router->comprobarRutas();
