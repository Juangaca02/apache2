<?php

class Parte
{
    protected $id;
    protected $dni_p;
    protected $dni_a;
    protected $motivo;
    protected $time;

    public function __construct($id, $dni_p, $dni_a, $motivo, $time)
    {
        $this->id = $id;
        $this->dni_p = $dni_p;
        $this->dni_a = $dni_a;
        $this->motivo = $motivo;
        $this->time = $time;
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