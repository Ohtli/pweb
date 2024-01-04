<?php 
    require 'database.php';
    session_start();
    if(!isset($_SESSION['curp'])){
        header("Location: login.php");
        exit();
    }
    if(!isset($_POST['acompanante']) || !isset($_POST['combobox'])){
        header("Location: usuario.php");
        exit();
    }
    $sql = "UPDATE users SET CONFIRMACION = curDate() ,ACOMPANANTE = :acompanante, DISCAPACIDAD = :discapacidad WHERE curp = :curp";
    $stmt = $conn->prepare($sql);
    echo $_POST['acompanante'];
    echo $_POST['combobox'];
    $stmt->execute(array(':acompanante' => $_POST['acompanante'], ':discapacidad' => $_POST['combobox'], ':curp' => $_SESSION['curp']));
    header("Location: usuario.php");
    exit();
?>