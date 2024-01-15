<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Eventos IPN</span>
            <a class="btn btn-danger" href="logout.php">Cerrar Sesión</a>
            </div>
            
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <h1>Bienvenido Administrador</h1>
        </div>
        <div class="row g-3">
            <div class="col">
            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#registrar" aria-expanded="false" onclick="showForm()">Crear nuevo galardonado</button>
            </div>
            <div class="col">
                <button class="btn btn-info" onclick="listAttendants(offsetGlobal)" data-bs-toggle="collapse" data-bs-target="#tabla-invitados">Listar galardonados</button>
            </div>    
            <div id="registrar" class="collapse col-12">
                <form>
                    <div class="row g-3">
                        <div class="col-8">
                            <div class="form-floating">
                                <input class="form-control"type="text" id="nombreInput" name="nombre" placeholder="Nombre">
                                <label for="nombreInput" class="form-label">Nombre</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="curpInput" name="curp" placeholder="CURP">
                                <label for="curpInput" class="form-label">CURP</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="categoriaInput" name="categoria" placeholder="Categoría">
                                <label class="form-label" for="categoriaInput">Categoría</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="dependenciaInput" name="dependencia" placeholder="Dependencia">
                                <label class="form-label" for="dependenciaInput">Dependencia</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="distincionInput" name="distincion" placeholder="Distinción">
                                <label class="form-label" for="distincionInput">Distinción</label>
                            </div>
                        </div>
                        <button class="btn btn-success col" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        
        
            <div class="collapse col" id="tabla-invitados">
            <table class="table col table-striped table-hover table-sm w-auto">
            <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Dependencia</th>
                    <th>Distincion</th>
                    <th>Categoria</th>
                    <th>CURP</th>
                    <th>Discapacidad</th>
                    <th>Confirmado</th>
                    <th>Acompañante</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="attendantsTableBody"></tbody>
            </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        let offsetGlobal = 0;
        function enableInput(input) {
            input.disabled = false;
        }
        function showForm() {
            var form = document.getElementById('newAttendantForm');
            form.style.display = 'block';
            form.onsubmit = function(e) {
                e.preventDefault();
                createAttendant();
            };
        }
        function listAttendants(offset) {
            // Logic to list all attendants
            fetch('listar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'offset=' + offset
            })
                .then(response => response.json())
                .then(attendants => {
                    // Do something with the attendants data
                    var tableBody = document.getElementById('attendantsTableBody');
                    if (offset === 0) {
                        tableBody.innerHTML = '';
                    }
                    attendants.forEach(attendant => {
                        var row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${attendant.id}</td>
                            <td><input type="text" value="${attendant.NOMBRE}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.DEPENDENCIA}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.DISTINCION}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" class="col-12" value="${attendant.CATEGORIA}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" class="col-12" value="${attendant.CURP}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" class="col-12" value="${attendant.DISCAPACIDAD}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" class="col-12" value="${attendant.CONFIRMACION}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" class="col-12" value="${attendant.ACOMPANANTE}" disabled ondblclick="enableInput(this)"></td>
                            <td><button onclick="deleteAttendant('${attendant.CURP}')">Eliminar</button></td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            offsetGlobal += 50;
        }

        function createAttendant() {
            
            var nombre = document.getElementById('nombreInput').value;
            var dependencia = document.getElementById('dependenciaInput').value;
            var distincion = document.getElementById('distincionInput').value;
            var categoria = document.getElementById('categoriaInput').value;
            var curp = document.getElementById('curpInput').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'crear.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Process the response
                    var response = xhr.responseText;
                    // Do something with the response
                    console.log(response);
                }
            };
            xhr.send('nombre=' + nombre + '&dependencia=' + dependencia + '&distincion=' + distincion + '&categoria=' + categoria + '&curp=' + curp);
        }

        function deleteAttendant(curp) {
            // Logic to delete an attendant
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'borrar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Process the response
                    var response = xhr.responseText;
                    // Do something with the response
                    console.log(response);
                }
            };
            xhr.send('curp=' + curp);
        }
    </script>
</body>
</html>
