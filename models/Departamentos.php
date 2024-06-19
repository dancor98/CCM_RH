<?php

namespace Model;

class Departamentos extends ActiveRecord
{
    protected static $tabla = 'departamentos';
    protected static $columnasDB = [
        'id',
        'nombre'
    ];

    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    //Mensajes de validacion
    public function validar_Departamento()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del departamento es obligatorio';
        }

        return self::$alertas;
    }
}
