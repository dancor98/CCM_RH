<?php

namespace Model;

class Incapacidades extends ActiveRecord
{
    protected static $tabla = 'boletas_Incapacidad';
    protected static $columnasDB = [
        'id',
        'colaborador_id',
        'fecha',
        'boleta',
        'motivo',
        'cantidad_dias'
    ];

    public $id;
    public $colaborador_id;
    public $fecha;
    public $boleta;
    public $motivo;
    public $cantidad_dias;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->colaborador_id = $args['colaborador_id'] ?? null;
        $this->fecha = $args['fecha'] ?? ''; // Corrección del campo 'fecha'
        $this->boleta = $args['boleta'] ?? '';
        $this->motivo = $args['motivo'] ?? '';
        $this->cantidad_dias = $args['cantidad_dias'] ?? 0;
    }

    // Mensajes de Validación
    public function validar()
    {
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }
        return self::$alertas;
    }
}
