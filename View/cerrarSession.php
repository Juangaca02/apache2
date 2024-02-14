<?php
session_start();
unset($_SESSION);
session_destroy();
// Importante la barra por que la ruta es la raiz del servidor
setcookie("PHPSESSID", 0, time() - 1, "/");
header("Location:index.php");
?>