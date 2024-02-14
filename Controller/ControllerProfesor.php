<?php
require_once '../Controller/conexion.php';
require_once '../Model/Profesores.php';

class ControllerProfesor
{
    public static function getProfesoresByDni($dni)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from profesores where dni_p = '$dni'");
            //$resultado = $stmt->get_result();
            if ($fila = $stmt->fetch_object()) {
                $profesor = new Profesores(
                    $fila->dni_p,
                    $fila->nombre,
                    $fila->apellidos,
                    $fila->pass,
                    $fila->bloqueado,
                    $fila->hora_bloqueo,
                    $fila->intentos
                );
            } else {
                $profesor = null;
            }
        } catch (Exception $ex) {
            $profesor = false;
        }
        $conn->close();
        return $profesor;
    }

    public static function getProfesoresByDniAndPass($dni, $pass)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from profesores where dni_p = '$dni' and pass = '$pass'");
            //$resultado = $stmt->get_result();
            if ($fila = $stmt->fetch_object()) {
                $profesor = new Profesores(
                    $fila->dni_p,
                    $fila->nombre,
                    $fila->apellidos,
                    $fila->pass,
                    $fila->bloqueado,
                    $fila->hora_bloqueo,
                    $fila->intentos
                );
            } else {
                $profesor = null;
            }
        } catch (Exception $ex) {
            $profesor = false;
        }
        $conn->close();
        return $profesor;
    }

    public static function updateIntentos($dni)
    {
        try {
            $valor = 0;
            $intentos = 3;
            $conn = new Conexion();
            $stmt = $conn->query("SELECT * from profesores where dni_p = '$dni'");
            while ($fila = $stmt->fetch_object()) {
                if (($fila->intentos) < 3) {
                    $conn->query("UPDATE profesores set intentos = intentos + 1 WHERE dni_p = '$dni'");
                    //return true;
                    $valor = $fila->intentos + 1;
                }
            }
            $conn->close();
            if ($valor == 3) {
                try {
                    $conn = new Conexion();
                    $conn->query("UPDATE profesores set bloqueado= 1 WHERE dni_p='$dni'");
                    $date = time();
                    $conn->query("UPDATE profesores set hora_bloqueo= $date WHERE dni_p='$dni'");
                    $conn->close();
                    print "Cuanta Bloqueada 1 Minuto";
                } catch (\Exception $ex) {
                    return false;
                }
            } else {
                $intentosRestantes = $intentos - $valor;
                print "Usuario o Clave incorrectos.<br>Te quedan $intentosRestantes intentos";
            }

        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function updateIntentosCorrecto($dni)
    {
        try {
            $conn = new Conexion();
            $conn->query("UPDATE profesores set intentos= 0 WHERE dni_p='$dni'");
            $conn->close();
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function getBloqueado($dni)
    {
        try {
            $conn = new Conexion();
            $stmt = $conn->query("SELECT * from proferores where dni_p = '$dni'");
            while ($fila = $stmt->fetch_object()) {
                if (($fila->bloqueado) == 1) {
                    $date = time();
                    if ($date >= (($fila->hora_bloqueado) + 60)) {
                        $conn->query("UPDATE profesores set bloqueado= 0 WHERE dni_p='$dni'");
                        $conn->query("UPDATE profesores set intentos= 0 WHERE dni_p='$dni'");
                        $conn->query("UPDATE profesores set hora_bloqueo= 0 WHERE dni_p='$dni'");
                        return false;
                    } else {
                        return true;
                    }
                }
            }
            $conn->close();
        } catch (\Exception $ex) {
            return false;
        }
    }

}