<?php
    require 'database.php';
    session_start();
    if(isset($_SESSION['admin'])){
        header("Location: admin_index.php");
        exit();
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        $sql = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':username' => $_POST['username'], ':password' => $_POST['password']));
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $_SESSION['admin'] = $_POST['username'];
            header("Location: admin_index.php");
        } else {
            header("Location: admin.php");
        }
    } else {
        header("Location: admin.php");
    }
?>