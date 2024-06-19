<?php

namespace Controllers;

use MVC\Router;

class PaginasController
{

    public static function index(Router $router)
    {
        $router->render('paginas/index', [
            'titulo' => 'inicio',
        ]);
    }

    public static function error(Router $router)
    {
        $router->render('paginas/error', [
            'titulo' => 'Error 404 - Pagina no encontrada'
        ]);
    }
}
