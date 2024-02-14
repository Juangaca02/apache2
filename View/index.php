<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        text-align: center;
    }
</style>
<?php

if (isset($_POST["aceptar"])) {
    require_once '../Controller/ControllerProfesor.php';
    if ((ControllerProfesor::getBloqueado($_POST["usuario"])) == true) {
        echo "Cuenta bloqueada";
    } else {
        $profesorDni = ControllerProfesor::getProfesoresByDni($_POST["usuario"]);
        if ($profesorDni === false)
            echo "Error en la base de datos1";
        if ($profesorDni === null)
            echo "El usuario no existe en la base de datos";
        if ($profesorDni) {
            $profesor = ControllerProfesor::getProfesoresByDniAndPass($_POST["usuario"], md5($_POST["clave"]));
            if ($profesor === false)
                echo "Error en la base de datos2";
            if ($profesor === null) {
                ControllerProfesor::updateIntentos($_POST["usuario"]);
            }
            if ($profesor) {
                ControllerProfesor::updateIntentosCorrecto($_POST["dni"]);
                session_start();
                $_SESSION["profesor"] = $profesor;
                header("Location:partes.php");
            }
        }
    }
}



?>

<body>
    <h1>Login</h1>
    <form action="" method="post">
        Usuario: <input type="text" name="usuario" value=""><br>
        Clave: <input type="text" name="clave" value=""><br>
        <input type="submit" name="aceptar" value="Aceptar">
    </form>
</body>

</html>