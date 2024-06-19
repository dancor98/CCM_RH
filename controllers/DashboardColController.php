<?php

namespace Controllers;

use Model\Colaboradores;
use MVC\Router;

use Intervention\Image\ImageManagerStatic as Image;

class DashboardColController
{

    public static function index(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $colaborador = Colaboradores::find($_SESSION['id']);


        $router->render('colaborador/dashboard/index', [
            'titulo' => 'Panel de Colaborador',
            'colaborador' => $colaborador
        ]);
    }


    public static function indexConfig(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $colaborador = Colaboradores::find($_SESSION['id']);


        $router->render('colaborador/configuracion/index', [
            'titulo' => 'Panel de Configuracion',
            'colaborador' => $colaborador
        ]);
    }


    //funcion para editar un ponente
    public static function reestablecer(Router $router)
    {

        $alertas = [];

        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        //Validar ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //vALIDA QUE REALMENTE SEA UN ENTERO

        if (!$id) {
            header('Location: /colaborador/configuracion');
        }

        //Obtener Ponente a Editar
        $colaborador = Colaboradores::find($id);

        if (!$colaborador) {
            header('Location: /colaborador/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $colaborador->sincronizar($_POST);

            // Validar el password
            $alertas = $colaborador->validarContrasena();

            if (empty($alertas)) {

                // Hashear el nuevo password
                $colaborador->hashContrasena();

                $resultado = $colaborador->guardar();

                if ($resultado) {
                    header('Location: /colaborador/configuracion?estado=exito');
                } else {
                    header('Location: /colaborador/configuracion?estado=error');
                }
            }
        }

        $router->render('colaborador/configuracion/cambiocontrasena', [
            'titulo' => 'Editar mi Informacion',
            'alertas' => $alertas,
            'colaborador' => $colaborador
        ]);
    }


    //funcion para editar un ponente
    public static function editar(Router $router)
    {

        $alertas = [];

        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        //Validar ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //vALIDA QUE REALMENTE SEA UN ENTERO

        if (!$id) {
            header('Location: /colaborador/dashboard');
        }

        //Obtener Ponente a Editar
        $colaborador = Colaboradores::find($id);

        if (!$colaborador) {
            header('Location: /colaborador/dashboard');
        }

        $colaborador->imagen_actual = $colaborador->foto;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
                header('Location: /login');
                return;
            }
            //Leer imagen 
            if (!empty($_FILES['foto']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/colaboradores'; //Direccion de carpeta
                //Crear carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['foto']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['foto']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['foto'] = "img/colaboradores/" . $nombre_imagen;
            } else {
                $_POST['foto'] = $colaborador->imagen_actual;
            }

            $colaborador->sincronizar($_POST);
            $alertas = $colaborador->validar();

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }

                $resultado = $colaborador->guardar();

                if ($resultado) {
                    header('Location: /colaborador/configuracion?estado=exito');
                } else {
                    header('Location: /colaborador/configuracion?estado=error');
                }
            }
        }

        $router->render('colaborador/configuracion/editarinfo', [
            'titulo' => 'Editar mi Informacion',
            'alertas' => $alertas,
            'colaborador' => $colaborador
        ]);
    }
}
