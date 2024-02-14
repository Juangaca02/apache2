<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
require_once '../Model/Profesores.php';
require_once '../Controller/ControllerPartes.php';
session_start();
if (isset($_SESSION["profesor"])) {
    echo '<a href="cerrarSession.php">Cerrar Session </a><a href="partes.php"> Inicio</a><br><br>';
    echo 'Profesor: ' . $_SESSION["profesor"]->nombre . ' ' . $_SESSION["profesor"]->apellidos;
}
if (isset($_POST["cerrarSession"])) {
    header("Location:cerrarSession.php");
}

if (isset($_POST["grabar"])) {
    ControllerPartes::createParte($_SESSION["profesor"]->dni_p, $_POST["dni"], $_POST["descripcion"], $_POST["id_curso"]);
    $_SESSION['alumno'] = $_POST["nombre1"];
    header('Location:partes.php');
}

?>

<body>
    <br>
    <?php echo 'D/Dª ' . $_SESSION["profesor"]->nombre . ' ' . $_SESSION["profesor"]->apellidos .
        ' como profesor de este centro, +++++++ que el alumno/a ' . $_POST["nombre"] .
        ' del grupo ' . $_POST["desripcion"] . ' ha cometido la siquiente falta:' . $_POST["id_curso"]; ?>
    <br>
    <form action="" method="post">
        <input type="hidden" name="dni" value="<?php echo $_POST["dni_alum"] ?>">
        <input type="hidden" name="nombre1" value="<?php echo $_POST["nombre"] ?>">
        <textarea name="descripcion" id="" cols="30" rows="10"></textarea><br>
        <input type="submit" name="grabar" value="Grabar parte">
    </form>

</body>

</html>