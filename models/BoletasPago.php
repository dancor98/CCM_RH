<?php

namespace Model;

class BoletasPago extends ActiveRecord
{

    protected static $tabla = 'boletas_pago';
    protected static $columnasDB = [
        'id',
        'colaborador_id',
        'fecha',
        'salario_quincenal',
        'comisiones',
        'incapacidades',
        'feriados',
        'total_devengado',
        'ccss',
        'impuestos_renta',
        'otras_deducciones',
        'embargo',
        'total_deducciones',
        'primer_quincena',
        'segunda_quincena',
        'empresa_id',
        'archivo_pdf',
        'periodo'

    ];

    public $id;
    public $colaborador_id;
    public $fecha;
    public $salario_quincenal;
    public $comisiones;
    public $incapacidades;
    public $feriados;
    public $total_devengado;
    public $ccss;
    public $impuestos_renta;
    public $otras_deducciones;
    public $embargo;
    public $total_deducciones;
    public $primer_quincena;
    public $segunda_quincena;
    public $empresa_id;
    public $archivo_pdf;
    public $periodo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->colaborador_id = $args['colaborador_id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->salario_quincenal = $args['salario_quincenal'] ?? null;
        $this->comisiones = $args['comisiones'] ?? null;
        $this->incapacidades = $args['incapacidades'] ?? null;
        $this->feriados = $args['feriados'] ?? null;
        $this->total_devengado = $args['total_devengado'] ?? null;
        $this->ccss = $args['ccss'] ?? null;
        $this->impuestos_renta = $args['impuestos_renta'] ?? null;
        $this->otras_deducciones = $args['otras_deducciones'] ?? null;
        $this->embargo = $args['embargo'] ?? null;
        $this->total_deducciones = $args['total_deducciones'] ?? null;
        $this->primer_quincena = $args['primer_quincena'] ?? null;
        $this->segunda_quincena = $args['segunda_quincena'] ?? null;
        $this->empresa_id = $args['empresa_id'] ?? null;
        $this->archivo_pdf = $args['archivo_pdf'] ?? '';
        $this->periodo = $args['periodo'] ?? '';
    }

    //Mensajes de Validacion
    public function validar()
    {
        if ($this->comisiones < 0) {
            self::$alertas['error'][] = 'Comisiones Obligatorias';
        }
        if ($this->incapacidades < 0) {
            self::$alertas['error'][] = 'Incapacidades Obligatorias';
        }
        if ($this->feriados < 0) {
            self::$alertas['error'][] = 'Feriados Obligatorias';
        }
        if ($this->otras_deducciones < 0) {
            self::$alertas['error'][] = 'Otras Deducciones Obligatorias';
        }
        if ($this->embargo < 0) {
            self::$alertas['error'][] = 'Embargos Obligatorias';
        }
        return self::$alertas;
    }
}
