<?php

namespace Controllers;

use Classes\Email;
use Classes\PDF;
use Classes\Paginacion;
use Model\Colaboradores;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\BoletasPago;
use Model\Empresas;

class BoletasPagoController
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
            header('Location: /admin/boletaspagos?page=1');
        }

        $registros_por_paginas = 10;
        $total = BoletasPago::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/boletaspagos?page=1');
        }

        $boletaspagos = BoletasPago::paginar($registros_por_paginas, $paginacion->offset());

        // Extrae las llaves foraneas
        foreach ($boletaspagos as $boletapago) {
            $boletapago->colaborador = Colaboradores::find($boletapago->colaborador_id);
            $boletapago->empresa = Empresas::find($boletapago->empresa_id);
        }

        $router->render('admin/boletaspagos/index', [
            'titulo' => 'Boletas de pago creadas',
            'boletaspagos' => $boletaspagos,
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
        $boletapago = new BoletasPago();
        $empresa_id = '';
        $empresa_nombre = '';
        $nombre_colaborador = '';
        $apellido_paterno = '';
        $apellido_materno = '';
        $cedula = '';
        $correo_electronico = '';
        $salario = '';

        // Capturar el ID del colaborador desde la URL
        $colaborador_id = $_GET['id'] ?? null;

        // Verificar si se proporcionó un ID válido
        if ($colaborador_id) {
            // Obtener el colaborador desde la base de datos
            $colaborador = Colaboradores::find($colaborador_id);

            if ($colaborador) {
                // Obtener datos del colaborador
                $nombre_colaborador = $colaborador->nombre;
                $apellido_paterno = $colaborador->apellido_paterno;
                $apellido_materno = $colaborador->apellido_materno;
                $cedula = $colaborador->cedula;
                $correo_electronico = $colaborador->correo_electronico;
                $salario = $colaborador->salario;

                // Obtener el ID y nombre de la empresa asociada al colaborador
                $empresa_id = $colaborador->empresa_id;
                $empresa = Empresas::find($empresa_id);
                $empresa_nombre = $empresa->nombre ?? '';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            // Sincronizar y validar datos de la boleta de pago
            $boletapago->sincronizar($_POST);
            $alertas = $boletapago->validar();

            if (empty($alertas)) {

                // Generar el PDF en memoria
                $pdf = new PDF();
                $carpetaDestino = __DIR__ . '/../public/uploads/boletasPago/';
                $nombreArchivoPDF = $pdf->generarPDF([
                    'nombre_empresa' => $empresa_nombre,
                    'Fecha' => date('Y-m-d'),
                    'Nombre' => $nombre_colaborador,
                    'Apellido' => $apellido_paterno . ' ' . $apellido_materno,
                    'Cedula' => $cedula,
                    'Base' => $salario,
                    'Quincenal' => $boletapago->salario_quincenal, // Añadir el salario quincenal al PDF
                    'Comisiones' => $boletapago->comisiones,
                    'Incapacidad' => $boletapago->incapacidades,
                    'Feriados' => $boletapago->feriados,
                    'devengado' => $boletapago->total_devengado,
                    'Ccss' => $boletapago->ccss,
                    'Renta' => $boletapago->impuestos_renta,
                    'Odeducciones' => $boletapago->otras_deducciones,
                    'Embargo' => $boletapago->embargo,
                    'Deducciones' => $boletapago->total_deducciones,
                    'Quincena1' => $boletapago->primer_quincena,
                    'Quincena2' => $boletapago->segunda_quincena,
                    'Periodo' => $boletapago->periodo
                ], $carpetaDestino);

                // Asignar el nombre del archivo generado al objeto BoletasPago
                $boletapago->archivo_pdf = 'uploads/boletasPago/' . basename($nombreArchivoPDF);

                // Guardar la boleta de pago en la base de datos
                $resultado = $boletapago->guardar();

                // Enviar el PDF por correo electrónico
                $email = new Email($correo_electronico, $nombre_colaborador, '');
                $email->enviarConfirmacionBoleta();


                if ($resultado) {
                    // Redirigir después de guardar y enviar el correo
                    header('Location: /admin/boletaspagos');
                    exit;
                }
            }
        }

        // Renderizar la vista con los datos necesarios
        $router->render('admin/boletaspagos/crear', [
            'titulo' => 'Registrar Boleta de Pago',
            'alertas' => $alertas,
            'boletapago' => $boletapago,
            'colaborador_id' => $colaborador_id,
            'empresa_id' => $empresa_id,
            'empresa_nombre' => $empresa_nombre,
            'nombre_colaborador' => $nombre_colaborador,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'cedula' => $cedula,
            'correo_electronico' => $correo_electronico,
            'salario' => $salario,
        ]);
    }

    //------------------------------------------------------------------------------//
    //Colaboradores

    public static function indexColaborador(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $colaborador = Colaboradores::find($_SESSION['id']);

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /colaborador/boletapago?page=1');
        }

        $registros_por_paginas = 10;
        $total = BoletasPago::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);
        $colaborador_id = $_SESSION['id'];

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /colaborador/boletapago?page=1');
        }

        $boletaspagos = BoletasPago::paginarColaboradores($registros_por_paginas, $paginacion->offset(), $colaborador_id);

        // Extrae las llaves foraneas
        foreach ($boletaspagos as $boletapago) {
            $boletapago->colaborador = Colaboradores::find($boletapago->colaborador_id);
            $boletapago->empresa = Empresas::find($boletapago->empresa_id);
        }

        $router->render('colaborador/boletapago/index', [
            'titulo' => 'Boletas de pago creadas',
            'boletaspagos' => $boletaspagos,
            'paginacion' => $paginacion->paginacion(),
            'colaborador' => $colaborador
        ]);
    }





    // public static function cargarDesdeCSV(Router $router)
    // {
    //     session_start();
    //     // Validar que el usuario esté logueado y sea administrador
    //     if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    //         header('Location: /login');
    //         return;
    //     }

    //     $alertas = [];

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         // Verificar si se ha subido un archivo CSV
    //         if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
    //             $fileTmpPath = $_FILES['csv_file']['tmp_name'];
    //             $fileName = $_FILES['csv_file']['name'];
    //             $fileSize = $_FILES['csv_file']['size'];
    //             $fileType = $_FILES['csv_file']['type'];
    //             $fileNameCmps = explode(".", $fileName);
    //             $fileExtension = strtolower(end($fileNameCmps));

    //             // Verificar la extensión del archivo
    //             if ($fileExtension === 'csv') {
    //                 // Abrir el archivo CSV para lectura
    //                 if (($handle = fopen($fileTmpPath, 'r')) !== false) {
    //                     // Leer los encabezados del CSV
    //                     $headers = fgetcsv($handle, 1000, ",");

    //                     // Procesar cada fila del CSV
    //                     while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    //                         // Crear una nueva instancia de BoletasPago
    //                         $boletapago = new BoletasPago();

    //                         // Asignar los valores del CSV a la instancia
    //                         // Asumiendo que el CSV tiene las columnas en el mismo orden que se definen aquí
    //                         $boletapago->empresa_id = $data[0]; //si
    //                         $boletapago->colaborador_id = $data[1]; //si
    //                         $boletapago->salario_quincenal = $data[2]; //si
    //                         $boletapago->comisiones = $data[3]; //si
    //                         $boletapago->incapacidades = $data[4]; //si
    //                         $boletapago->feriados = $data[5]; //si
    //                         $boletapago->total_devengado = $data[6]; //si
    //                         $boletapago->ccss = $data[7]; //si
    //                         $boletapago->impuestos_renta = $data[8]; //si
    //                         $boletapago->otras_deducciones = $data[9]; //si
    //                         $boletapago->embargo = $data[10]; //si
    //                         $boletapago->total_deducciones = $data[11]; //si
    //                         $boletapago->primer_quincena = $data[12]; //si
    //                         $boletapago->segunda_quincena = $data[13]; //si
    //                         $boletapago->periodo = $data[14]; //si
    //                         $boletapago->fecha = $data[15]; //si

    //                         // Obtener el colaborador desde la base de datos
    //                         $colaborador = Colaboradores::find($boletapago->colaborador_id);
    //                         $empresa = Empresas::find($boletapago->empresa_id);

    //                         if ($colaborador && $empresa) {
    //                             // Generar el PDF en memoria
    //                             $pdf = new PDF();
    //                             $carpetaDestino = __DIR__ . '/../public/uploads/boletasPago/';
    //                             $nombreArchivoPDF = $pdf->generarPDF([
    //                                 'nombre_empresa' => $empresa->nombre ?? '',
    //                                 'Fecha' => date('Y-m-d'),
    //                                 'Nombre' => $colaborador->nombre ?? '',
    //                                 'Apellido' => ($colaborador->apellido_paterno ?? '') . ' ' . ($colaborador->apellido_materno ?? ''),
    //                                 'Cedula' => $colaborador->cedula ?? '',
    //                                 'Base' => $colaborador->salario ?? '',
    //                                 'Quincenal' => $boletapago->salario_quincenal,
    //                                 'Comisiones' => $boletapago->comisiones,
    //                                 'Incapacidad' => $boletapago->incapacidades,
    //                                 'Feriados' => $boletapago->feriados,
    //                                 'devengado' => $boletapago->total_devengado,
    //                                 'Ccss' => $boletapago->ccss,
    //                                 'Renta' => $boletapago->impuestos_renta,
    //                                 'Odeducciones' => $boletapago->otras_deducciones,
    //                                 'Embargo' => $boletapago->embargo,
    //                                 'Deducciones' => $boletapago->total_deducciones,
    //                                 'Quincena1' => $boletapago->primer_quincena,
    //                                 'Quincena2' => $boletapago->segunda_quincena,
    //                                 'Periodo' => $boletapago->periodo
    //                             ], $carpetaDestino);

    //                             // Asignar el nombre del archivo generado al objeto BoletasPago
    //                             $boletapago->archivo_pdf = 'uploads/boletasPago/' . basename($nombreArchivoPDF);

    //                             // Guardar la boleta de pago en la base de datos
    //                             $resultado = $boletapago->guardar();

    //                             // Enviar el PDF por correo electrónico
    //                             $correo_electronico = $colaborador->correo_electronico ?? '';
    //                             $nombre_colaborador = $colaborador->nombre ?? '';
    //                             $email = new Email($correo_electronico, $nombre_colaborador, '');
    //                             $email->enviarConfirmacionBoleta();

    //                             if (!$resultado) {
    //                                 $alertas[] = "Error al guardar la boleta de pago para el colaborador ID: {$boletapago->colaborador_id}";
    //                             }
    //                         } else {
    //                             $alertas[] = "No se encontró el colaborador o la empresa para el colaborador ID: {$boletapago->colaborador_id}";
    //                         }
    //                     }
    //                     fclose($handle);

    //                     // Redirigir después de procesar el archivo
    //                     header('Location: /admin/boletaspagos');
    //                     exit;
    //                 } else {
    //                     $alertas[] = 'No se pudo abrir el archivo CSV.';
    //                 }
    //             } else {
    //                 $alertas[] = 'El archivo debe ser de tipo CSV.';
    //             }
    //         } else {
    //             $alertas[] = 'Error al cargar el archivo CSV.';
    //         }
    //     }

    //     // Renderizar la vista con los datos necesarios
    //     $router->render('admin/boletaspagos/cargar', [
    //         'titulo' => 'Crear Boletas Pago CSV',
    //         'alertas' => $alertas
    //     ]);
    // }

    public static function cargarDesdeCSV(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si se ha subido un archivo CSV
            if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['csv_file']['tmp_name'];
                $fileName = $_FILES['csv_file']['name'];
                $fileSize = $_FILES['csv_file']['size'];
                $fileType = $_FILES['csv_file']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Verificar la extensión del archivo
                if ($fileExtension === 'csv') {
                    // Abrir el archivo CSV para lectura
                    if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                        // Leer los encabezados del CSV
                        $headers = fgetcsv($handle, 1000, ",");

                        // Procesar cada fila del CSV
                        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                            // Crear una nueva instancia de BoletasPago
                            $boletapago = new BoletasPago();

                            // Asignar los valores del CSV a la instancia, omitiendo los campos no necesarios
                            $boletapago->colaborador_id = $data[0];
                            $boletapago->empresa_id = $data[1];
                            $boletapago->salario_quincenal = $data[7];
                            $boletapago->comisiones = $data[8];
                            $boletapago->feriados = $data[9];
                            $boletapago->total_devengado = $data[10];
                            $boletapago->ccss = $data[11];
                            $boletapago->impuestos_renta = $data[12];
                            $boletapago->otras_deducciones = $data[13];
                            $boletapago->embargo = $data[14];
                            $boletapago->incapacidades = $data[15];
                            $boletapago->total_deducciones = $data[16];
                            $boletapago->primer_quincena = $data[17];
                            $boletapago->segunda_quincena = $data[18];
                            $boletapago->periodo = $data[19];
                            $boletapago->fecha = $data[20];

                            // Obtener el colaborador desde la base de datos
                            $colaborador = Colaboradores::find($boletapago->colaborador_id);
                            $empresa = Empresas::find($boletapago->empresa_id);

                            if ($colaborador && $empresa) {
                                // Generar el PDF en memoria
                                $pdf = new PDF();
                                $carpetaDestino = __DIR__ . '/../public/uploads/boletasPago/';
                                $nombreArchivoPDF = $pdf->generarPDF([
                                    'nombre_empresa' => $empresa->nombre ?? '',
                                    'Fecha' => date('Y-m-d'),
                                    'Nombre' => $colaborador->nombre ?? '',
                                    'Apellido' => ($colaborador->apellido_paterno ?? '') . ' ' . ($colaborador->apellido_materno ?? ''),
                                    'Cedula' => $colaborador->cedula ?? '',
                                    'Base' => $colaborador->salario ?? '',
                                    'Quincenal' => $boletapago->salario_quincenal,
                                    'Comisiones' => $boletapago->comisiones,
                                    'Incapacidad' => $boletapago->incapacidades,
                                    'Feriados' => $boletapago->feriados,
                                    'devengado' => $boletapago->total_devengado,
                                    'Ccss' => $boletapago->ccss,
                                    'Renta' => $boletapago->impuestos_renta,
                                    'Odeducciones' => $boletapago->otras_deducciones,
                                    'Embargo' => $boletapago->embargo,
                                    'Deducciones' => $boletapago->total_deducciones,
                                    'Quincena1' => $boletapago->primer_quincena,
                                    'Quincena2' => $boletapago->segunda_quincena,
                                    'Periodo' => $boletapago->periodo
                                ], $carpetaDestino);

                                // Asignar el nombre del archivo generado al objeto BoletasPago
                                $boletapago->archivo_pdf = 'uploads/boletasPago/' . basename($nombreArchivoPDF);

                                // Guardar la boleta de pago en la base de datos
                                $resultado = $boletapago->guardar();

                                // Enviar el PDF por correo electrónico
                                $correo_electronico = $colaborador->correo_electronico ?? '';
                                $nombre_colaborador = $colaborador->nombre ?? '';
                                $email = new Email($correo_electronico, $nombre_colaborador, '');
                                $email->enviarConfirmacionBoleta();

                                if (!$resultado) {
                                    $alertas[] = "Error al guardar la boleta de pago para el colaborador ID: {$boletapago->colaborador_id}";
                                }
                            } else {
                                $alertas[] = "No se encontró el colaborador o la empresa para el colaborador ID: {$boletapago->colaborador_id}";
                            }
                        }
                        fclose($handle);

                        // Redirigir después de procesar el archivo
                        header('Location: /admin/boletaspagos');
                        exit;
                    } else {
                        $alertas[] = 'No se pudo abrir el archivo CSV.';
                    }
                } else {
                    $alertas[] = 'El archivo debe ser de tipo CSV.';
                }
            } else {
                $alertas[] = 'Error al cargar el archivo CSV.';
            }
        }

        // Renderizar la vista con los datos necesarios
        $router->render('admin/boletaspagos/cargar', [
            'titulo' => 'Crear Boletas Pago CSV',
            'alertas' => $alertas
        ]);
    }
}
