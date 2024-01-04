<?php
require 'database.php';
session_start();
if(!isset($_SESSION['admin'])){
    exit();
}
if(!isset($_POST['curp']) || !isset($_POST['dependencia']) || !isset($_POST['distincion']) || !isset($_POST['nombre']) || !isset($_POST['acompanante']) || !isset($_POST['discapacidad']) || !isset($_POST['confirmacion'])){
    exit();
}

if(validar_curp($_POST['curp'])){
    echo json_encode(array('error' => true, 'mensaje' => 'CURP no válida'));
    exit();
}
$sql = "UPDATE users SET DEPENDENCIA = :dependencia, DISTINCION = :distincion, NOMBRE = :nombre, ACOMPANANTE = :acompanante, DISCAPACIDAD = :discapacidad, CONFIRMACION = :confirmacion WHERE curp = :curp";
$stmt = $conn->prepare($sql);
$resultado = $stmt->execute(array(':dependencia' => $_POST['dependencia'], ':distincion' => $_POST['distincion'], ':nombre' => $_POST['nombre'], ':acompanante' => $_POST['acompanante'], ':discapacidad' => $_POST['discapacidad'], ':confirmacion' => $_POST['confirmacion'], ':curp' => $_POST['curp']));
if(!$resultado){
    echo json_encode(array('error' => true, 'mensaje' => 'Error al modificar asistente'));
    exit();
}
echo json_encode(array('error' => false, 'mensaje' => 'Asistente modificado correctamente'));