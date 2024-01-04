<?php 
require 'database.php';
session_start();
if(!isset($_SESSION['admin'])){
    exit();
}
if(!isset($_POST['curp'])){
    exit();
}
$sql = "DELETE FROM users WHERE curp = :curp";
$stmt = $conn->prepare($sql);
$resultado = $stmt->execute(array(':curp' => $_POST['curp']));
if(!$resultado){
    echo json_encode(array('error' => true));
    exit();
} 
echo json_encode(array('error' => false));
