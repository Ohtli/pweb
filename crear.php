<?php
require 'database.php';
require 'validaciones.php';
session_start();
if(!isset($_SESSION['admin'])){
    echo json_encode(array('error' => true, 'mensaje' => 'No tienes permiso para realizar esta acción'));
    exit();
}
if(!isset($_POST['curp']) || !isset($_POST['dependencia']) || !isset($_POST['distincion']) || !isset($_POST['nombre']) || !isset($_POST['categoria'])){
    echo json_encode(array('error' => true, 'mensaje' => 'Faltan datos'));
    exit();
}
if(!validar_curp($_POST['curp'])){
    echo json_encode(array('error' => true, 'mensaje' => 'CURP no válida'));
    exit();
}
$sql = "INSERT INTO users (NOMBRE, DEPENDENCIA, DISTINCION, CATEGORIA, CURP) VALUES (:nombre, :dependencia, :distincion, :categoria, :curp)";
$stmt = $conn->prepare($sql);
$resultado = $stmt->execute(array(':curp' => $_POST['curp'], ':dependencia' => $_POST['dependencia'], ':distincion' => $_POST['distincion'], ':nombre' => $_POST['nombre'], ':categoria' => $_POST['categoria']));

if(!$resultado){
    echo json_encode(array('error' => true, 'mensaje' => 'Error al registrar asistente'));
    exit();
}

echo json_encode(array('error' => false, 'mensaje' => 'Asistente registrado correctamente'));