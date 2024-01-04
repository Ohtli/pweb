<?php 
    
    require_once __DIR__ . '/vendor/autoload.php'; // Include mPDF library
    require 'database.php';
    $mpdf = new \Mpdf\Mpdf();   
    session_start();
    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE curp = :curp";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':curp' => $_SESSION['curp']));
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultados) == 1) {
        $datos = $resultados[0];
    } else {
        $datos = $resultados[0];
        $datos['DISTINCION'] = array(0 => $datos['DISTINCION'], 1 => $resultados[1]['DISTINCION']);
    }

    // Create a new mPDF instance
    

    // Set the PDF header content
    $header = '
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="text-align: center; background-color: #f2f2f2; padding: 10px;">
                    <h1>Invitación</h1>
                </td>
            </tr>
        </table>
    ';

    // Set the PDF header content
    $mpdf->SetHTMLHeader($header);

    // Add your PDF content here
    $mpdf->WriteHTML('<br><h2>Detalles</h2>');
    $mpdf->WriteHTML('<p>Id: ' . $datos['id'] . '</p>');
    $mpdf->WriteHTML('<p>Nombre: ' . $datos['NOMBRE'] . '</p>');
    $mpdf->WriteHTML('<p>CURP: ' . $datos['CURP'] . '</p>');
    $mpdf->WriteHTML('<p>Discapacidad: ' . $datos['DISCAPACIDAD'] . '</p>');
    $mpdf->WriteHTML('<p>Distincion(es): </p>');
    foreach($datos['DISTINCION']as $dist){
        $mpdf->WriteHTML('<p>' . $dist . '</p>');
    }
    $mpdf->WriteHTML('<p>Fecha de confirmación: ' . $datos['CONFIRMACION'] . '</p>');
    if($datos['ACOMPANANTE'] == 1){
        $mpdf->AddPage();
        $mpdf->WriteHTML('<h2>Invitación acompañante</h2>');
        $mpdf->WriteHTML('<p>Id: ' . $datos['id'] . '</p>');
        $mpdf->WriteHTML('<p>Nombre: ' . $datos['NOMBRE'] . '</p>');
        $mpdf->WriteHTML('<p>CURP: ' . $datos['CURP'] . '</p>');
        $mpdf->WriteHTML('<p>Discapacidad: ' . $datos['DISCAPACIDAD'] . '</p>');
        $mpdf->WriteHTML('<p>Distincion(es): </p>');
        foreach($datos['DISTINCION']as $dist){
            $mpdf->WriteHTML('<p>' . $dist . '</p>');
        }
    }
    // Output the PDF
    $mpdf->Output('user_details.pdf', 'D');
    
    
?>