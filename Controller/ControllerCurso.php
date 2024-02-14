<?php
require_once '../Controller/conexion.php';
require_once '../Model/Curso.php';
require_once '../Model/Prof_curso.php';

class ControllerCurso
{
    public static function getCursosbyId($id)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from curso where id_curso = $id");
            //$resultado = $stmt->get_result();
            while ($result = $stmt->fetch_object()) {
                $cursos[] = new Curso(
                    $result->id_curso,
                    $result->descripcion,
                    $result->totalpartes
                );
            }
            $stmt = null;
            $conn = null;
        } catch (Exception $ex) {
            echo "Fallo en listadoCursos";
        }
        return $cursos;
    }

    public static function getProfCurso($dni)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from prof_curso where dni_p = '$dni'");
            //$resultado = $stmt->get_result();
            while ($result = $stmt->fetch_object()) {
                $profCurso[] = new Prof_curso(
                    $result->dni_p,
                    $result->id_curso
                );
            }
            $stmt = null;
            $conn = null;
        } catch (Exception $ex) {
            echo "Fallo en listadoCursos";
        }
        return $profCurso;
    }

    public static function getidCurso($desc)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from curso where descripcion = '$desc'");
            //$resultado = $stmt->get_result();
            if ($fila = $stmt->fetch_object()) {
                $cursos = new Curso(
                    $fila->id_curso,
                    $fila->descripcion,
                    $fila->totalpartes
                );
            } else {
                $cursos = null;
            }
        } catch (Exception $ex) {
            $cursos = false;
        }
        $conn->close();
        return $cursos;
    }


    public static function prueba($dni)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from curso where id_curso = '$dni'");
            //$resultado = $stmt->get_result();
            if ($fila = $stmt->fetch_object()) {
                $cursos = new Curso(
                    $fila->id_curso,
                    $fila->descripcion,
                    $fila->totalpartes
                );
            } else {
                $cursos = null;
            }
        } catch (Exception $ex) {
            $cursos = false;
        }
        $conn->close();
        return $cursos;
    }

}