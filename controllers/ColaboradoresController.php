<?php

namespace Controllers;

use Classes\Email;
use Classes\Paginacion;
use Model\Colaboradores;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Departamentos;
use Model\Empresas;

class ColaboradoresController
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
            header('Location: /admin/colaboradores?page=1');
        }

        $registros_por_paginas = 10;
        $total = Colaboradores::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/colaboradores?page=1');
        }

        $colaboradores = Colaboradores::paginar($registros_por_paginas, $paginacion->offset());

        //Extrae las llaves foraneas
        foreach ($colaboradores as $colaborador) {
            $colaborador->departamento = Departamentos::find($colaborador->departamento_id);
            $colaborador->empresa = Empresas::find($colaborador->empresa_id);
        }

        $router->render('admin/colaboradores/index', [
            'titulo' => 'Colaboradores Activos',
            'colaboradores' => $colaboradores,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    //Funcion para crear un Colaborador
    public static function registro(Router $router)
    {
        $alertas = [];

        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $departamentos = Departamentos::all('ASC');
        $empresas = Empresas::all('ASC');

        $usuario = new Colaboradores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_cuenta();
            if (empty($alertas)) {
                $existeUsuario = Colaboradores::where('correo_electronico', $usuario->correo_electronico);
                if ($existeUsuario) {
                    Colaboradores::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Colaboradores::getAlertas();
                } else {
                    // Hashear la contrasena
                    $usuario->hashContrasena();

                    // Eliminar password2
                    unset($usuario->contrasena2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->correo_electronico, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($resultado) {
                        header('Location: /admin/colaboradores');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('admin/colaboradores/crear', [
            'titulo' => 'Crear Colaborador',
            'departamentos' => $departamentos,
            'empresas' => $empresas,
            'colaborador' => $usuario,
            'alertas' => $alertas
        ]);
    }

    //funcion para editar un ponente
    public static function editar(Router $router)
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
            header('Location: /admin/colaboradores');
        }

        $departamentos = Departamentos::all('ASC');
        $empresas = Empresas::all('ASC');

        //Obtener Colaborador a Editar
        $colaborador = Colaboradores::find($id);

        if (!$colaborador) {
            header('Location: /admin/colaboradores');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $colaborador->sincronizar($_POST);
            $alertas = $colaborador->validar();

            if (empty($alertas)) {

                $resultado = $colaborador->guardar();

                if ($resultado) {
                    header('Location: /admin/colaboradores');
                }
            }
        }

        $router->render('admin/colaboradores/editar', [
            'titulo' => 'Editar Colaborador',
            'alertas' => $alertas,
            'colaborador' => $colaborador,
            'departamentos' => $departamentos,
            'empresas' => $empresas
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
            header('Location: /admin/colaboradores');
        }

        // $departamentos = Departamentos::all('ASC');
        $empresas = Empresas::all('ASC');

        //Obtener Colaborador a Editar
        $colaborador = Colaboradores::find($id);

        $colaborador->departamento = Departamentos::find($colaborador->departamento_id);
        $colaborador->empresa = Empresas::find($colaborador->empresa_id);

        if (!$colaborador) {
            header('Location: /admin/colaboradores');
        }

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //     session_start();
        //     // Validar que el usuario esté logueado y sea administrador
        //     if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        //         header('Location: /login');
        //         return;
        //     }

        //     $colaborador->sincronizar($_POST);
        //     $alertas = $colaborador->validar();

        //     if (empty($alertas)) {

        //         $resultado = $colaborador->guardar();

        //         if ($resultado) {
        //             header('Location: /admin/colaboradores');
        //         }
        //     }
        // }

        $router->render('admin/colaboradores/observar', [
            'titulo' => 'Observar Colaborador',
            'alertas' => $alertas,
            'colaborador' => $colaborador,
            'departamento' => $departamento,
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
            $colaborador = Colaboradores::find($id);
            if (!isset($colaborador)) {
                header('Location: /admin/colaboradores');
            }
            $resultado = $colaborador->eliminar();
            if ($resultado) {
                header('Location: /admin/colaboradores');
            }
        }
    }

    public static function Descargar(Router $router)
    {

        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        // Nombre del archivo CSV
        $fileName = 'colaboradores_activos' . date('y-m-d') . '.csv';

        // Configurar el tipo de respuesta
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrir el archivo en modo escritura
        $output = fopen('php://output', 'w');

        // Escribir encabezados de columna
        fputcsv($output, [
            'id',
            'empresa_id',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'cedula',
            'salario'
        ]);

        // Obtener los datos de la tabla (ejemplo usando Eloquent ORM)
        $datos = Colaboradores::all(); // Reemplaza MiTabla con el nombre real de tu tabla

        // Escribir datos de la tabla
        foreach ($datos as $dato) {
            fputcsv($output, [
                $dato->id, // Ajusta el acceso a tus columnas según el nombre real
                $dato->empresa_id,
                $dato->nombre,
                $dato->apellido_paterno,
                $dato->apellido_materno,
                $dato->cedula,
                $dato->salario
            ]);
        }

        // Cerrar el archivo
        fclose($output);
        exit;
    }
}
