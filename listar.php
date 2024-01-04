<?php
require 'database.php';
session_start();
if(!isset($_SESSION['admin'])){
    exit();
}
if(!isset($_POST['offset'])){
    exit();
}
$offset = $_POST['offset'];
$sql = "SELECT * FROM users ORDER BY id ASC LIMIT 50 OFFSET $offset";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
