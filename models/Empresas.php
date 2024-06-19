<?php

namespace Model;

class Empresas extends ActiveRecord
{

    protected static $tabla = 'empresa';
    protected static $columnasDB = [
        'id',
        'nombre',
        'cedula'
    ];

    public $id;
    public $nombre;
    public $cedula;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->cedula = $args['cedula'] ?? '';
    }

    //Mensajes de Validacion
    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre de la empresa es obligatorio';
        }
        if (strlen($this->cedula) < 10) {
            self::$alertas['error'][] = 'La cedula juridica tiene que tener al menos 10 digitos';
        }
        if (!preg_match('/^\d+$/', $this->cedula)) {
            self::$alertas['error'][] = 'La cédula jurídica solo debe contener números';
        }
        return self::$alertas;
    }
}
