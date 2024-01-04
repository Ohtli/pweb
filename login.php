<?php
    require 'database.php';
    require 'validaciones.php';
    session_start();
    if(isset($_SESSION['curp'])){
        header("Location: usuario.php");
    } else{
    
        $curp = $_POST['curp'];
        //$exp = "/[a-z][a|e|i|o|u][a-z][a-z][0-9]{6}(h|m|x)[a-z]{2}[a-z]{3}([0-9]|[a-z])[0-9]/i";
            if (validar_curp($curp)) {
                $sql = "SELECT * FROM users WHERE curp = :curp";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':curp' => $curp));
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($resultado) > 0) {
                    $_SESSION['curp'] = $resultado[0]['CURP'];
                    $_SESSION['id'] = $resultado[0]['id'];
                    $_SESSION['nombre'] = $resultado[0]['NOMBRE'];
                    $_SESSION['dependencia'] = $resultado[0]['DEPENDENCIA'];
                    $_SESSION['categoria'] = $resultado[0]['CATEGORIA'];
                    $_SESSION['discapacidad'] = $resultado[0]['DISCAPACIDAD'];
                    $_SESSION['confirmacion'] = $resultado[0]['CONFIRMACION'];
                    $_SESSION['acompanante'] = $resultado[0]['ACOMPANANTE'];
                    if(count($resultado) == 1){
                        $_SESSION['distincion'] = $resultados[0];
                    } else {
                        $_SESSION['distincion'] = array(0=>$resultados[0]['DISTINCION'],1=>$resultados[1]['DISTINCION']);
                    }
                    header("Location: usuario.php");
                    $conn = null;
                } else {
                    header("Location: index.php");
                }
            } else {
                header("Location: index.php");
            }
    }
?>
