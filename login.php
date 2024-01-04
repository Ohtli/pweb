<?php
    require 'database.php';
    session_start();
    if(isset($_SESSION['curp'])){
        header("Location: usuario.php");
    } else{
    
        $curp = $_POST['curp'];
        $exp = "/[a-z][a|e|i|o|u][a-z][a-z][0-9]{6}(h|m|x)[a-z]{2}[a-z]{3}([0-9]|[a-z])[0-9]/i";
            if (preg_match($exp, $curp)) {
                $sql = "SELECT * FROM users WHERE curp = :curp";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':curp' => $curp));
                $resultado = $stmt->fetchAll();
                if (count($resultado) > 0) {
                    $_SESSION['curp'] = $curp;
                    header("Location: admin_index.php");
                } else {
                    header("Location: index.php");
                }
            } else {
                header("Location: index.php");
            }
    }
?>
