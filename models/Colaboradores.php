<?php

namespace Model;

class Colaboradores extends ActiveRecord
{
    protected static $tabla = 'colaboradores';
    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'cedula',
        'fecha_nacimiento',
        'correo_electronico',
        'telefono',
        'departamento_id',
        'puesto',
        'empresa_id',
        'salario',
        'contrasena',
        'token',
        'admin',
        'fecha_ingreso',
        'foto',
        'dias_utilizados',
        'meses_trabajados',
        'confirmado',
        'nombre_emergencia',
        'telefono_emergencia'
    ];

    public $id;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $cedula;
    public $fecha_nacimiento;
    public $correo_electronico;
    public $telefono;
    public $departamento_id;
    public $puesto;
    public $empresa_id;
    public $salario;
    public $contrasena;
    public $contrasena2;
    public $token;
    public $admin;
    public $fecha_ingreso;
    public $foto;
    public $dias_utilizados;
    public $meses_trabajados;
    public $confirmado;
    public $nombre_emergencia;
    public $telefono_emergencia;


    public $contrasena_nueva;
    public $contrasena_actual;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido_paterno = $args['apellido_paterno'] ?? '';
        $this->apellido_materno = $args['apellido_materno'] ?? '';
        $this->cedula = $args['cedula'] ?? null;
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->correo_electronico = $args['correo_electronico'] ?? '';
        $this->telefono = $args['telefono'] ?? null;
        $this->departamento_id = $args['departamento_id'] ?? null;
        $this->puesto = $args['puesto'] ?? '';
        $this->empresa_id = $args['empresa_id'] ?? null;
        $this->salario = $args['salario'] ?? null;
        $this->contrasena = $args['contrasena'] ?? '';
        $this->contrasena2 = $args['contrasena2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->fecha_ingreso = $args['fecha_ingreso'] ?? '';
        $this->foto = $args['foto'] ?? 'null';
        $this->dias_utilizados = $args['dias_utilizados'] ?? 0;
        $this->meses_trabajados = $args['meses_trabajados'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->nombre_emergencia = $args['nombre_emergencia'] ?? '';
        $this->telefono_emergencia = $args['telefono_emergencia'] ?? 0;
    }

    //validar el login de Usuarios
    public function ValidarLogin()
    {
        if (!$this->correo_electronico) {
            self::$alertas['error'][] = 'El correo electronico es obligatorio';
        }
        if (!filter_var($this->correo_electronico, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Correo electronico no valido';
        }
        if (!$this->contrasena) {
            self::$alertas['error'][] = 'La contrasena es obligatoria';
        }
        return self::$alertas;
    }

    //Validar Registro de nuevos Colaboradores
    public function Validar_cuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (preg_match('/[0-9]/', $this->nombre)) {
            self::$alertas['error'][] = 'El nombre no debe contener números';
        }
        if (!$this->apellido_paterno) {
            self::$alertas['error'][] = 'El apellido paterno es obligatorio';
        }
        if (preg_match('/[0-9]/', $this->apellido_paterno)) {
            self::$alertas['error'][] = 'El apellido paterno no debe contener números';
        }
        if (!$this->apellido_materno) {
            self::$alertas['error'][] = 'El apellido materno es obligatorio';
        }
        if (preg_match('/[0-9]/', $this->apellido_materno)) {
            self::$alertas['error'][] = 'El apellido materno no debe contener números';
        }
        if (!$this->cedula) {
            self::$alertas['error'][] = 'La cedula es obligatoria';
        }
        if (!preg_match('/^[0-9]+$/', $this->cedula)) {
            self::$alertas['error'][] = 'La cedula debe contener solo números';
        }
        if (strlen($this->cedula) < 9) {
            self::$alertas['error'][] = 'La cedula tiene que tener un minimo de 9 digitos, verifique que no existan espacios';
        }

        if (!$this->correo_electronico) {
            self::$alertas['error'][] = 'El correo electronico es obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }
        if (strlen($this->telefono) < 8) {
            self::$alertas['error'][] = 'El telefono tiene que tener minimo 8 digitos';
        }
        if (!preg_match('/^[0-9]+$/', $this->telefono)) {
            self::$alertas['error'][] = 'El telefono debe contener solo números, verifique que no existan espacios';
        }

        if (!$this->puesto) {
            self::$alertas['error'][] = 'El puesto es obligatorio';
        }
        if (preg_match('/[0-9]/', $this->puesto)) {
            self::$alertas['error'][] = 'El puesto no debe contener números';
        }
        if (!$this->salario) {
            self::$alertas['error'][] = 'El salario es obligatorio';
        }
        if (!preg_match('/^[0-9]+$/', $this->salario)) {
            self::$alertas['error'][] = 'El salario debe contener solo números, verifique que no existan espacios';
        }
        if (!$this->contrasena) {
            self::$alertas['error'][] = 'La contrasena es obligatoria';
        }
        if (strlen($this->contrasena) < 6) {
            self::$alertas['error'][] = 'La contrasena debe ser mayor a 6 caracteres';
        }
        if (!$this->fecha_nacimiento) {
            self::$alertas['error'][] = 'Debe ingresar la fecha de nacimiento';
        }
        if (!$this->fecha_ingreso) {
            self::$alertas['error'][] = 'Debe ingresar la fecha de ingreso';
        }


        return self::$alertas;
    }

    //Validar un Email
    public function validarCorreo()
    {
        if (!$this->correo_electronico) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!filter_var($this->correo_electronico, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }

    //Validar el Password
    public function validarContrasena()
    {
        if (!$this->contrasena) {
            self::$alertas['error'][] = 'El contrasena no puede ir vacio';
        }
        if (strlen($this->contrasena) < 6) {
            self::$alertas['error'][] = 'El contrasena debe contener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    //validacion nueva contrasena
    public function nueva_contrasena(): array
    {
        if (!$this->contrasena_actual) {
            self::$alertas['error'][] = 'La contrasena Actual es obligatoria';
        }
        if (!$this->contrasena_nueva) {
            self::$alertas['error'][] = 'La contrasena Nueva es obligatoria';
        }
        if (strlen($this->contrasena_nueva) < 6) {
            self::$alertas['error'][] = 'La contrasena debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    //Comprobar contrasena
    public function comprobar_contrasena(): bool
    {
        return password_verify($this->contrasena_actual, $this->contrasena);
    }

    //hashear contrasena
    public function hashContrasena(): void
    {
        $this->contrasena = password_hash($this->contrasena, PASSWORD_BCRYPT);
    }

    //Generar un token 
    public function crearToken(): void
    {
        $this->token = uniqid();
    }
}
