<?php

namespace Model;

use Model\Colaboradores;

class Vacaciones extends ActiveRecord
{

    protected static $tabla = 'solicitud_vacaciones';
    protected static $columnasDB = [
        'id',
        'colaborador_id',
        'cantidad',
        'detalle',
        'fecha',
        'estado',
        'comentario',
        'desde',
        'hasta'
    ];

    public $id;
    public $colaborador_id;
    public $cantidad;
    public $detalle;
    public $fecha;
    public $estado;
    public $comentario;
    public $desde;
    public $hasta;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->colaborador_id = $args['colaborador_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->detalle = $args['detalle'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? 'Pendiente';
        $this->comentario = $args['comentario'] ?? '';
        $this->desde = $args['desde'] ?? '';
        $this->hasta = $args['hasta'] ?? '';
    }

    //Mensajes de Validacion
    public function validar()
    {

        $colaborador = Colaboradores::find($_SESSION['id']);
        // debuguear($colaborador);

        if (!$this->colaborador_id) {
            self::$alertas['error'][] = 'El ID del colaborador es obligatorio';
        }
        if (!$this->cantidad) {
            self::$alertas['error'][] = 'La Cantidad de dias es obligatoria';
        }


        if (!$this->detalle) {
            self::$alertas['error'][] = 'El detalle es obligatorio';
        }

        return self::$alertas;
    }
}
