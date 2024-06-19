<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Departamentos;
use MVC\Router;

class DepartamentosController
{

    public static function index(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/departamentos?page=1');
        }

        $registros_por_paginas = 10;
        $total = Departamentos::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/departamentos?page=1');
        }

        $departamentos = Departamentos::paginar($registros_por_paginas, $paginacion->offset());


        $router->render('admin/departamentos/index', [
            'titulo' => 'Departamentos',
            'departamentos' => $departamentos,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $alertas = [];
        $departamento = new Departamentos();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }
            $departamento->sincronizar($_POST);
            $alertas = $departamento->validar_Departamento();
            if (empty($alertas)) {
                $resultado = $departamento->guardar();
                if ($resultado) {
                    header('Location: /admin/departamentos');
                    return;
                }
            }
        }

        $router->render('admin/departamentos/crear', [
            'titulo' => 'Registrar Departamento',
            'alertas' => $alertas,
            'departamento' => $departamento
        ]);
    }

    //funcion para editar un ponente
    public static function editar(Router $router)
    {
        $alertas = [];
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        //Validar ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //vALIDA QUE REALMENTE SEA UN ENTERO

        if (!$id) {
            header('Location: /admin/departamentos');
        }

        //Obtener Ponente a Editar
        $departamento = Departamentos::find($id);

        if (!$departamento) {
            header('Location: /admin/departamentos');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $departamento->sincronizar($_POST);
            $alertas = $departamento->validar();

            if (empty($alertas)) {

                $resultado = $departamento->guardar();

                if ($resultado) {
                    header('Location: /admin/departamentos');
                }
            }
        }

        $router->render('admin/departamentos/editar', [
            'titulo' => 'Editar Departamento',
            'alertas' => $alertas,
            'departamento' => $departamento
        ]);
    }


    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $id = $_POST['id'];
            $departamento = Departamentos::find($id);
            if (!isset($departamento)) {
                header('Location: /admin/departamentos');
                return;
            }
            $resultado = $departamento->eliminar();
            if ($resultado) {
                header('Location: /admin/departamentos');
                return;
            }
        }
    }
}
