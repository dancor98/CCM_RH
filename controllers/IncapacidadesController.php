<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Colaboradores;
use Model\Incapacidades;
use MVC\Router;

class IncapacidadesController
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
            header('Location: /admin/incapacidades?page=1');
        }

        $registros_por_paginas = 10;
        $total = Incapacidades::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/incapacidades?page=1');
        }

        $incapacidades = Incapacidades::paginar($registros_por_paginas, $paginacion->offset());

        foreach ($incapacidades as $incapacidad) {
            $incapacidad->colaborador = Colaboradores::find($incapacidad->colaborador_id);
        }

        $router->render('admin/incapacidades/index', [
            'titulo' => 'Incapacidades Cargadas',
            'incapacidades' => $incapacidades,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function observar(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $alertas = [];

        //Validar ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //vALIDA QUE REALMENTE SEA UN ENTERO

        if (!$id) {
            header('Location: /admin/incapacidades');
        }

        //Obtener Colaborador a Editar
        $incapacidad = Incapacidades::find($id);

        $incapacidad->colaborador = Colaboradores::find($incapacidad->colaborador_id);


        if (!$incapacidad) {
            header('Location: /admin/incapacidades');
        }


        $router->render('admin/incapacidades/observar', [
            'titulo' => 'Observar Incapacidad',
            'alertas' => $alertas,
            'incapacidad' => $incapacidad,

        ]);
    }


    //-----------------------------------------------------------------------------------------------//
    //Colaboradores

    public static function indexColaborador(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /colaborador/incapacidades?page=1');
        }

        $colaborador = Colaboradores::find($_SESSION['id']);

        $registros_por_paginas = 10;
        $total = Incapacidades::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);
        $colaborador_id = $_SESSION['id'];

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /colaborador/incapacidades?page=1');
        }

        $incapacidades = Incapacidades::paginarColaboradores($registros_por_paginas, $paginacion->offset(), $colaborador_id);

        foreach ($incapacidades as $incapacidad) {
            $incapacidad->colaborador = Colaboradores::find($incapacidad->colaborador_id);
        }

        $router->render('colaborador/incapacidades/index', [
            'titulo' => 'Incapacidades Cargadas',
            'incapacidades' => $incapacidades,
            'paginacion' => $paginacion->paginacion(),
            'colaborador' => $colaborador
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $alertas = [];
        $incapacidad = new Incapacidades();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $incapacidad->sincronizar($_POST);
            $alertas = $incapacidad->validar();

            // Manejar la carga del archivo PDF
            if (isset($_FILES['boleta']) && $_FILES['boleta']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['boleta']['name'];
                $rutaTemporal = $_FILES['boleta']['tmp_name'];
                $carpetaDestino = __DIR__ . '/../public/uploads/incapacidades/'; // Ruta dentro de 'public'

                // Crear la carpeta si no existe
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0755, true);
                }

                // Limpiar el nombre del archivo
                $nombreArchivo = strtolower(str_replace([' ', '_'], '-', $nombreArchivo));
                $nombreArchivo = preg_replace('/[^a-z0-9\-\.]/', '', $nombreArchivo);

                // Mover el archivo a la carpeta destino
                $rutaArchivo = $carpetaDestino . uniqid() . '-' . $nombreArchivo;
                if (move_uploaded_file($rutaTemporal, $rutaArchivo)) {
                    // Guardar la ruta relativa a 'public' en la base de datos
                    $incapacidad->boleta = 'uploads/incapacidades/' . basename($rutaArchivo);
                } else {
                    $alertas[] = 'Error al mover el archivo PDF.';
                }
            } else {
                $alertas[] = 'Error al cargar el archivo PDF.';
            }

            if (empty($alertas)) {
                $resultado = $incapacidad->guardar();
                if ($resultado) {
                    header('Location: /colaborador/incapacidades?estado=exito');
                    return;
                } else {
                    header('Location: /colaborador/incapacidades?estado=error');
                }
            }
        }

        $colaborador = Colaboradores::find($_SESSION['id']);


        $router->render('colaborador/incapacidades/crear', [
            'titulo' => 'Registrar Incapacidad',
            'alertas' => $alertas,
            'incapacidad' => $incapacidad,
            'colaborador' => $colaborador
        ]);
    }
}
