<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<?php
require_once '../Model/Profesores.php';
require_once '../Controller/ControllerPartes.php';
require_once '../Controller/ControllerProfesor.php';
session_start();
if (isset($_SESSION["profesor"])) {
    echo '<a href="cerrarSession.php">Cerrar Session </a><a href="partes.php"> Inicio</a><br><br>';
    echo 'Profesor: ' . $_SESSION["profesor"]->nombre . ' ' . $_SESSION["profesor"]->apellidos;
}
if (isset($_POST['nombre'])) {
    echo '<h1>Historial de parted del parte:' . $_POST["nombre"] . '</h1>';
}
if (isset($_POST["cerrarSession"])) {
    header("Location:cerrarSession.php");
}
?>

<body>
    <?php
    $partes = ControllerPartes::mostrarPartesAlumno($_POST["dni_alum"]);
    if ($partes !== false) {
        // Verificar si hay partes para mostrar
        if ($partes !== null) {
            // Iterar sobre las partes y mostrar la información
            echo '<table border="1"><tr><th>Fecha</th><th>Profesor</th><th>Motivo</th><th>Quitar Parte</th></tr>';
            foreach ($partes as $parte) {
                ?>
                <tr>
                    <td>
                        <?php
                        $fechaHora = date("d/m/Y", $parte->time);
                        echo $fechaHora; ?>
                    </td>
                    <td>
                        <?php
                        $profesor = ControllerProfesor::getProfesoresByDni($parte->dni_p);
                        echo $profesor->nombre . ' ' . $profesor->apellidos
                            ?>
                    </td>
                    <td>
                        <?php echo $parte->motivo ?>
                    </td>
                    <td>
                        <?php
                        if (!($profesor->dni_p == $_SESSION["profesor"]->dni_p)) {

                        } else {
                            ?>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $parte->id ?>">
                                <input type="hidden" name="nombreAlum" value="<?php echo $parte->id ?>">
                                <input type="submit" name="quitarParte" value="Quitar Parte">
                            </form>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
    }


    if (isset($_POST["quitarParte"])) {
        if (ControllerPartes::deleteParte($_POST["id"])) {
            $_SESSION['eliminadoParte'] = 'Se ha eliminado el parte del Alumno' . $_POST["nombreAlum"];
            //cancelamos la sesion cita para que no nos de conflicto 
            unset($_SESSION['cita']);
        } else {
            echo 'error al eliminar la cita';
        }
    }



    ?>
</body>

</html>