<%-- 
    Document   : register
    Created on : 5 mar 2024, 20:27:13
    Author     : migue
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h2>Register</h2>
        <form action="s2" method="post">
            <label for="username">Nombre de Usuario:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" name="register" value="Registrar">
        </form>
    </body>
</html>
