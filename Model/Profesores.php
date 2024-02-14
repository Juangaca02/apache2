<?php

class Profesores
{
    protected $dni_p;
    protected $nombre;
    protected $apellidos;
    protected $pass;
    protected $bloqueado;
    protected $hora_bloqueo;
    protected $intentos;

    public function __construct($dni_p, $nombre, $apellidos, $pass, $bloqueado, $hora_bloqueo, $intentos)
    {
        $this->dni_p = $dni_p;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->pass = $pass;
        $this->bloqueado = $bloqueado;
        $this->hora_bloqueo = $hora_bloqueo;
        $this->intentos = $intentos;
    }
    public function __get($name)
    {
        return $this->$name;
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}