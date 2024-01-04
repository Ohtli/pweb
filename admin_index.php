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
    <title>Admin Page</title>
</head>
<body>
    <h1>Página Admin</h1>
    <button onclick="listAttendants(offsetGlobal)">Listar galardonados</button>
    <button onclick="showForm()">Crear nuevo galardonado</button>

    <div id="newAttendantForm" style="display: none;">
        <form>
            <label for="nombreInput">Nombre:</label>
            <input type="text" id="nombreInput" name="nombre" placeholder="Nombre">

            <label for="dependenciaInput">Dependencia:</label>
            <input type="text" id="dependenciaInput" name="dependencia" placeholder="Dependencia">

            <label for="distincionInput">Distinción:</label>
            <input type="text" id="distincionInput" name="distincion" placeholder="Distinción">

            <label for="categoriaInput">Categoría:</label>
            <input type="text" id="categoriaInput" name="categoria" placeholder="Categoría">

            <label for="curpInput">CURP:</label>
            <input type="text" id="curpInput" name="curp" placeholder="CURP">

            <button type="submit">Registrar</button>
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>NOMBRE</th>
                <th>DEPENDENCIA</th>
                <th>DISTINCION</th>
                <th>CATEGORIA</th>
                <th>CURP</th>
                <th>DISCAPACIDAD</th>
                <th>CONFIRMACION</th>
                <th>ACOMPANANTE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody id="attendantsTableBody"></tbody>
    </table>
    <a href="logout.php">SALIR</a>

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
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'listar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Process the response
                    var attendants = JSON.parse(xhr.responseText);
                    // Do something with the attendants data
                    var tableBody = document.getElementById('attendantsTableBody');
                    if(offset === 0){
                        tableBody.innerHTML = '';
                    }
                    attendants.forEach(function(attendant) {
                        var row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${attendant.id}</td>
                            <td><input type="text" value="${attendant.NOMBRE}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.DEPENDENCIA}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.DISTINCION}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.CATEGORIA}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.CURP}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.DISCAPACIDAD}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.CONFIRMACION}" disabled ondblclick="enableInput(this)"></td>
                            <td><input type="text" value="${attendant.ACOMPANANTE}" disabled ondblclick="enableInput(this)"></td>
                            <td><button onclick="deleteAttendant('${attendant.CURP}')">Eliminar</button></td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            };
            xhr.send('offset=' + offset);
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
