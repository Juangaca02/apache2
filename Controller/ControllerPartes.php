<?php
require_once '../Controller/conexion.php';
require_once '../Model/Parte.php';

class ControllerPartes
{
    public static function createParte($dni_p, $dni_a, $motivo, $id_curso)
    {

        try {
            $date = time();
            $conn = new conexion();
            $conn->query("INSERT INTO `partes`(`dni_p`, `dni_a`, `motivo`, `time`) VALUES ('$dni_p','$dni_a','$motivo','$date')");
            $conn->query("UPDATE curso set totalpartes = totalpartes + 1 WHERE id_curso = $id_curso");
            $conn->close();
        } catch (\Exception $ex) {
            echo 'Falo';
        }
    }

    public static function mostrarPartesAlumno($dni)
    {
        try {
            $conn = new conexion();
            $stmt = $conn->query("SELECT * from partes where dni_a = '$dni'");
            //$resultado = $stmt->get_result();
            while ($result = $stmt->fetch_object()) {
                $partes[] = new Parte(
                    $result->id,
                    $result->dni_p,
                    $result->dni_a,
                    $result->motivo,
                    $result->time
                );
            }
            $stmt = null;
            $conn = null;
        } catch (Exception $ex) {
            echo "Fallo en listadoPartes";
        }
        return $partes;
    }

    public static function deleteParte($id)
    {
        try {
            $conn = new conexion();
            //$conn->query("UPDATE curso set totalpartes = totalpartes - 1 WHERE id_curso=$id_curso");
            $stmt = $conn->query("DELETE from partes where id = $id");
            if ($stmt > 0) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Fallo en Al borrar parte";
        }
        return false;
    }

}