<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
require_once '../Model/Profesores.php';
require_once '../Controller/ControllerCurso.php';
require_once '../Controller/ControllerAlumno.php';
session_start();
if (isset($_SESSION["profesor"])) {
    echo '<a href="cerrarSession.php">Cerrar Session</a><br><br>';
    echo 'Profesor: ' . $_SESSION["profesor"]->nombre . ' ' . $_SESSION["profesor"]->apellidos;
}

if (isset($_SESSION['alumno'])) {
    echo '<p>El Profesor' . $_SESSION["profesor"]->nombre . ' ' . $_SESSION["profesor"]->apellidos . ' ha grabado una nueva incidencia para el alumno ' . $_SESSION['alumno'] . '</p';
    unset($_SESSION['alumno']);
}

if (isset($_POST["cerrarSession"])) {
    header("Location:cerrarSession.php");
}
?>

<body>
    <br>
    Seleccione el curso del alumno/a:
    <?php

    $profesores = ControllerCurso::getProfCurso($_SESSION["profesor"]->dni_p);
    if ($profesores !== false) {
        // Verificar si hay profesor para mostrar
        if ($profesores !== null) {
            // Iterar sobre las cursos y mostrar la información
            echo '<br><form action="" method="post"><select name="cursos">';
            foreach ($profesores as $profesor) {
                $cursos = ControllerCurso::getCursosbyId($profesor->id_curso);
                if ($cursos !== false) {
                    // Verificar si hay cursos para mostrar
                    if ($cursos !== null) {
                        // Iterar sobre las cursos y mostrar la información
                        foreach ($cursos as $curso) {
                            echo "<option value='$curso->id_curso'";
                            if (isset($_POST['cursos']) && $_POST['cursos'] == $curso->descripcion) {
                                echo " selected ";
                            }
                            echo '> ' . $curso->descripcion . ' </option>';
                        }

                    }
                }
            }
            echo '<input type="submit" name="SeleccionarCurso" value="Seleccionar Curso" ></form>';
        }
    }




    // Verificar si se obtuvieron cuentas
    

    if (isset($_POST['SeleccionarCurso'])) {
        $cursos2 = ControllerCurso::prueba($_POST['cursos']);
        echo '<h3>Este curso tiene ' . $cursos2->descripcion . ' </h3>';
        $alumnos = ControllerAlumno::getAlumnoFromIdCurso($cursos2->id_curso);
        if ($alumnos !== false) {
            // Verificar si hay alumnos para mostrar
            if ($alumnos !== null) {
                // Iterar sobre las alumnos y mostrar la información
                echo '<table border="1"><tr><th>Alumnos</th><th>Acciones</th></tr>';
                foreach ($alumnos as $alumno) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $alumno->nombre . ' ' . $alumno->apellidos ?>
                        </td>
                        <td>
                            <form action="nuevoparte.php" method="post">
                                <input type="hidden" name="dni_alum" value="<?php echo $alumno->dni_a ?>">
                                <input type="hidden" name="nombre" value="<?php echo $alumno->nombre . ' ' . $alumno->apellidos ?>">
                                <input type="hidden" name="desripcion" value="<?php echo $cursos2->descripcion ?>">
                                <input type="hidden" name="id_curso" value="<?php echo $cursos2->id_curso ?>">
                                <input type="submit" name="nuevaparte" value="Nuevo Parte">
                            </form>
                            <form action="historial.php" method="post">
                                <input type="hidden" name="nombre" value="<?php echo $alumno->nombre . ' ' . $alumno->apellidos ?>">
                                <input type="hidden" name="dni_alum" value="<?php echo $alumno->dni_a ?>">
                                <input type="submit" name="historial" value="historial">
                            </form>
                        </td>
                    </tr>
                    <?php
                }

            }
        }
    }
    ?>
</body>
<table border="1">

</table>

</html>