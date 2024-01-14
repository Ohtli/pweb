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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>

    </header>
    <div class="container-sm">
        <main>
            <div class="row g-3">
                <div class="col-sm-12 col-md-12">
                    <h1>Bienvenid@ <?php echo htmlspecialchars($_SESSION['nombre']) ?></h1>
                    
                </div>
                <div class="col-sm-12 col-md-5">
                <?php
                        if($_SESSION['confirmacion'] != null){
                            echo "<p>Ha confirmado su asistencia</p>";
                            echo "<p>Fecha de confirmación: " .$_SESSION['confirmacion']."</p>";
                            echo "<a class='link-success' href='descargar_pdf.php' target='_blank'>Descargue su invitación</a>";
                        } else{
                            require_once 'formulario.html';
                        } 
                    ?>
                </div>
                
            </div>
        </main>
    </div>
    
    

    
    <a href="logout.php">Cerrar Sesión</a>
    <script>
        function confirmar(event){
            event.preventDefault();
            let discapacidad = document.getElementById('discapacidad').value;
            let acompanante = document.getElementById('acompanante').checked;
            let data = new FormData();
            data.append('discapacidad', discapacidad);
            data.append('acompanante', acompanante);
            fetch('confirmar.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    alert(data.message);
                } else{
                    alert(data.message);
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error(error);
            });
        }
        const form = document.getElementById('formulario');
        form.addEventListener('submit', confirmar);
    </script>
</body>
</html>