<?php
    session_start();
    if(isset($_SESSION['curp'])){
        $_SESSION = array();
        session_destroy();
    }
    if(isset($_SESSION['admin'])){
        header("Location: admin_index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistentes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<form method="POST" action="login_admin.php">
    <label for="username">Admin:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <input type="submit" value="Login">
</form>
</body>