<?php

namespace Classes;

use TCPDF;

class PDF
{
    public function generarPDF($data, $carpetaDestino)
    {
        // Crear nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Configurar el documento PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CCM Soluciones en Servicios S.A.');
        $pdf->SetTitle('Comprobante de Pago');
        $pdf->SetSubject('Comprobante de Pago');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Establecer márgenes
        $pdf->SetMargins(10, 10, 10);

        // Añadir una página
        $pdf->AddPage();

        // Establecer contenido del PDF
        $pdf->SetFont('helvetica', '', 10);

        // Definir constantes para encabezados
        define('HEADER_TITLE', $data['nombre_empresa']);
        define('PDF_TITLE', 'COMPROBANTE DE PAGO');

        // HTML para el contenido del PDF
        $html = "
            <h1 style='text-align:center'>" . HEADER_TITLE . "</h1>
            <h2 style='text-align:center'>" . PDF_TITLE . "</h2>
        
            <p style='text-align:center;'>Fecha Creacion: {$data['Fecha']}</p>
            <p style='text-align:center;'>Periodo: {$data['Periodo']} </br></p>
            

            <table cellspacing='0' cellpadding='1' border='1'>
                <tr>
                    <td>Nombre:</td>
                    <td>{$data['Nombre']} {$data['Apellido']}</td>
                </tr>
                <tr>
                    <td>Cedula:</td>
                    <td>{$data['Cedula']}</td>
                </tr>
            </table>

            </br>
            <hr>

            <h3>Ingresos</h3>
            <table cellspacing='0' cellpadding='1' border='1'>
                <tr>
                    <td>Salario base mensual:</td>
                    <td>¢{$data['Base']}</td>
                </tr>
                <tr>
                    <td>Salario quincenal:</td>
                    <td>¢{$data['Quincenal']}</td>
                </tr>
                <tr>
                    <td>Comisiones:</td>
                    <td>¢{$data['Comisiones']}</td>
                </tr>
                <tr>
                    <td>Incapacidad / Días no laborados:</td>
                    <td>¢{$data['Incapacidad']}</td>
                </tr>
                <tr>
                    <td>Feriados:</td>
                    <td>¢{$data['Feriados']}</td>
                </tr>
                <tr>
                    <td>Total devengado:</td>
                    <td>¢{$data['devengado']}</td>
                </tr>
            </table>

            </br>
            <hr>

            <h3>Deducciones</h3>
            <table cellspacing='0' cellpadding='1' border='1'>
                <tr>
                    <td>CCSS 10.67%:</td>
                    <td>¢{$data['Ccss']}</td>
                </tr>
                <tr>
                <td>Incapacidad / Días no laborados:</td>
                <td>¢{$data['Incapacidad']}</td>
            </tr>
                <tr>
                    <td>Impuesto de renta:</td>
                    <td>¢{$data['Renta']}</td>
                </tr>
                <tr>
                    <td>Otras Deducciones:</td>
                    <td>¢{$data['Odeducciones']}</td>
                </tr>
                <tr>
                    <td>Embargo:</td>
                    <td>¢{$data['Embargo']}</td>
                </tr>
                <tr>
                    <td>Total deducciones:</td>
                    <td>¢{$data['Deducciones']}</td>
                </tr>
            </table>

            </br>
            <hr>
            </br>

            

            <h3>Salario a pagar I quincena</h3>
            <p>¢{$data['Quincena1']}</p>

            <h3>Salario a pagar II quincena</h3>
            <p>¢{$data['Quincena2']}</p>
        ";

        // Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar un nombre de archivo único
        $nombreArchivoPDF = 'boleta_pago_' . uniqid() . '.pdf';

        // Guardar el PDF en la carpeta destino
        $pdf->Output($carpetaDestino . $nombreArchivoPDF, 'F');

        // Devolver el nombre del archivo generado
        return $nombreArchivoPDF;
    }
}
