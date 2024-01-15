<?php
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-6">
                    <form class="row g-3" action="login.php" method="POST">
                        <div class="col-12">
                            <label class="form-label" for="curp">Curp</label>
                            <input class="form-control" type="text" id="curp" name="curp">
                        </div>
                        <div class="col">
                            <input class="btn btn-primary" type="submit" value="Ingresar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </body>
    </html>
