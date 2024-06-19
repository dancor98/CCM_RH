<?php

namespace Controllers;

use Model\Colaboradores;
use Model\Vacaciones;
use MVC\Router;

class DashboardController
{

    public static function index(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $colaboradoresTotal = Colaboradores::totalGeneral();
        $solicitudvacacionesN = Vacaciones::totalVacacionesN();

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administracion',
            'colaboradoresTotal' => $colaboradoresTotal,
            'solicitudvacacionesN' => $solicitudvacacionesN
        ]);
    }
}
