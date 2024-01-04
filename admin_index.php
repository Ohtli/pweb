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
    <button onclick="createAttendant()">Crear nuevo galardonado</button>

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
            </tr>
        </thead>
        <tbody id="attendantsTableBody"></tbody>
    </table>
    <a href="logout.php">SALIR</a>

    <script>
        let offsetGlobal = 0;
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
                            <td>${attendant.NOMBRE}</td>
                            <td>${attendant.DEPENDENCIA}</td>
                            <td>${attendant.DISTINCION}</td>
                            <td>${attendant.CATEGORIA}</td>
                            <td>${attendant.CURP}</td>
                            <td>${attendant.DISCAPACIDAD}</td>
                            <td>${attendant.CONFIRMACION}</td>
                            <td>${attendant.ACOMPANANTE}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            };
            xhr.send('offset=' + offset);
            offsetGlobal += 50;
        }

        function createAttendant() {
            // Logic to create a new attendant
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
