<?php 
    require 'database.php';
    session_start();
    if(!isset($_SESSION['curp'])){
        echo json_encode(array('error' => true, 'message' => 'No se ha iniciado sesión'));
        exit();
    }
    if(!isset($_POST['acompanante'])){
        $acompanante = 0;
    } else{
        $acompanante = $_POST['acompanante'];
    }
    if(!isset($_POST['discapacidad'])){
        echo json_encode(array('error' => true, 'message' => 'No se ha recibido discapacidad'));
    }
    $sql = "UPDATE users SET CONFIRMACION = curDate() ,ACOMPANANTE = :acompanante, DISCAPACIDAD = :discapacidad WHERE curp = :curp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':acompanante', $acompanante, PDO::PARAM_INT);
    
    $stmt->bindParam(':discapacidad', $_POST['discapacidad'], PDO::PARAM_STR);
    $stmt->bindParam(':curp', $_SESSION['curp'], PDO::PARAM_STR);
    $stmt->execute();
    
    if($stmt->rowCount() < 1){
        echo json_encode(array('error' => true, 'message' => 'No se pudo confirmar su asistencia'));
        exit();
    }
    echo json_encode(array('error' => false, 'message' => 'Se ha confirmado su asistencia'));
    $_SESSION['confirmacion'] = date("Y-m-d");
    $_SESSION['discapacidad'] = $_POST['discapacidad'];
    $_SESSION['acompanante'] = $acompanante;
    exit();
?>