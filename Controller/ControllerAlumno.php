<?php
require_once '../Controller/conexion.php';
require_once '../Model/Alumno.php';

class ControllerAlumno
{
    public static function getAlumnoFromIdCurso($id)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from alumnos where id_curso = $id");
            //$resultado = $stmt->get_result();
            while ($result = $stmt->fetch_object()) {
                $Alumnos[] = new Alumno(
                    $result->dni_a,
                    $result->nombre,
                    $result->apellidos,
                    $result->direccion,
                    $result->telf,
                    $result->id_curso
                );
            }
            $stmt = null;
            $conn = null;
        } catch (Exception $ex) {
            echo "Fallo en listadoCursos";
        }
        return $Alumnos;
    }


}