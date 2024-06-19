<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Empresas;
use MVC\Router;

class EmpresasController
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
            header('Location: /admin/empresas?page=1');
        }

        $registros_por_paginas = 10;
        $total = Empresas::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/empresas?page=1');
        }

        $empresas = Empresas::paginar($registros_por_paginas, $paginacion->offset());


        $router->render('admin/empresas/index', [
            'titulo' => 'Empresas Activas',
            'empresas' => $empresas,
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
        $empresa = new Empresas();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }
            $empresa->sincronizar($_POST);
            $alertas = $empresa->validar();
            if (empty($alertas)) {
                $resultado = $empresa->guardar();
                if ($resultado) {
                    header('Location: /admin/empresas');
                    return;
                } else {
                    echo 'Error';
                }
            }
        }

        $router->render('admin/empresas/crear', [
            'titulo' => 'Registrar Empresa',
            'alertas' => $alertas,
            'empresa' => $empresa
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
            header('Location: /admin/empresas');
        }

        //Obtener Ponente a Editar
        $empresa = Empresas::find($id);

        if (!$empresa) {
            header('Location: /admin/empresa');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $empresa->sincronizar($_POST);
            $alertas = $empresa->validar();

            if (empty($alertas)) {

                $resultado = $empresa->guardar();

                if ($resultado) {
                    header('Location: /admin/empresas');
                }
            }
        }

        $router->render('admin/empresas/editar', [
            'titulo' => 'Editar Empresa',
            'alertas' => $alertas,
            'empresa' => $empresa
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
            $empresa = Empresas::find($id);
            if (!isset($empresa)) {
                header('Location: /admin/empresas');
                return;
            }
            $resultado = $empresa->eliminar();
            if ($resultado) {
                header('Location: /admin/empresa');
                return;
            }
        }
    }
}
