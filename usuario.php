<?php
    session_start();
    if(!isset($_SESSION['curp'])){
        header("Location: login.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h1>Bienvenido <?php echo $_SESSION['nombre'] ?></h1>
    <?php foreach($_SESSION as $d => $da){
        if(is_array($da)){
            echo "<p>$d: ";
            foreach($da as $d2 => $da2){
                echo "$da2 ";
            }
            echo "</p>";
        } else
        echo "<p>$d: $da</p>";
    } 
    ?>
    <h2>Confirmar</h2>
    <form action="confirmar.php" method="POST">
        <label for="acompanante">¿Llevaras acompanante?</label>
        <input type="radio" id="acompanante" name="acompanante" value="1"> Si
        <input type="radio" id="acompanante" name="acompanante" value="0"> No

        <label for="combobox">¿Sufres alguna discapacidad?</label>
        <select id="combobox" name="combobox">
            <option value="1">Bastón</option>
            <option value="2">Muletas</option>
            <option value="3">Silla de Ruedas</option>
            <option value="4">Perro Guía</option>
            <option value="5">Ninguna</option>
            <option value="6">Otro</option>
        </select>
        <input type="submit" value="Confirmar">
    </form>

    <?php
        if($_SESSION['confirmacion'] != null){
            echo "<p>Confirmado</p>";
            echo "<p>Fecha de confirmación:" .$_SESSOIN['confirmacion']."</p>";
            echo "<a href='descargar_pdf.php'>PDF</a>";
        }
    ?>

    
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>