<?php
require 'database.php';
require 'validaciones.php';
session_start();
if(!isset($_SESSION['admin'])){
    exit();
}
if(!isset($_POST['curp']) || !isset($_POST['dependencia']) || !isset($_POST['distincion']) || !isset($_POST['nombre']) || !isset($_POST['acompanante']) || !isset($_POST['discapacidad']) || !isset($_POST['confirmacion']) || !isset($_POST['categoria'])){
    exit();
}
if(!validar_curp($_POST['curp'])){
    echo json_encode(array('error' => true, 'mensaje' => 'CURP no válida'));
    exit();
}
$sql = "INSERT INTO users (curp, dependencia, distincion, nombre, acompanante, discapacidad, confirmacion, categoria) VALUES (:curp, :dependencia, :distincion, :nombre, :acompanante, :discapacidad, :confirmacion, :categoria)";
$stmt = $conn->prepare($sql);
$resultado = $stmt->execute(array(':curp' => $_POST['curp'], ':dependencia' => $_POST['dependencia'], ':distincion' => $_POST['distincion'], ':nombre' => $_POST['nombre'], ':acompanante' => $_POST['acompanante'], ':discapacidad' => $_POST['discapacidad'], ':confirmacion' => $_POST['confirmacion'], ':categoria' => $_POST['categoria']));

if(!$resultado){
    echo json_encode(array('error' => true, 'mensaje' => 'Error al registrar asistente'));
    exit();
}

echo json_encode(array('error' => false, 'mensaje' => 'Asistente registrado correctamente'));