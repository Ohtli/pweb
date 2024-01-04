<?php 
    if(!isset($_SESSION['curp'])){
        header("Location: login.php");
        exit();
    }
    require_once __DIR__ . '/vendor/autoload.php'; // Include mPDF library
    $mpdf = new \Mpdf\Mpdf();   
    session_start();
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
    $mpdf->WriteHTML('<p>Id: ' . $_SESSION['id'] . '</p>');
    $mpdf->WriteHTML('<p>Nombre: ' . $_SESSION['nombre'] . '</p>');
    $mpdf->WriteHTML('<p>CURP: ' . $_SESSION['curp'] . '</p>');
    $mpdf->WriteHTML('<p>Discapacidad: ' . $_SESSION['discapacidad'] . '</p>');
    $mpdf->WriteHTML('<p>Distincion(es): </p>');
    foreach($_SESSION['distincion']as $dist){
        $mpdf->WriteHTML('<p>' . $dist . '</p>');
    }
    $mpdf->WriteHTML('<p>Fecha de confirmación: ' . $_SESSION['confirmacion'] . '</p>');
    if($_SESSION['acompanante'] == 1){
        $mpdf->AddPage();
        $mpdf->WriteHTML('<h2>Invitación acompañante</h2>');
        $mpdf->WriteHTML('<p>Id: ' . $_SESSION['id'] . '</p>');
        $mpdf->WriteHTML('<p>Nombre: ' . $_SESSION['nombre'] . '</p>');
        $mpdf->WriteHTML('<p>CURP: ' . $_SESSION['curp'] . '</p>');
        $mpdf->WriteHTML('<p>Discapacidad: ' . $_SESSION['discapacidad'] . '</p>');
        $mpdf->WriteHTML('<p>Distincion(es): </p>');
        foreach($_SESSION['distincion']as $dist){
            $mpdf->WriteHTML('<p>' . $dist . '</p>');
        }
    }
    // Output the PDF
    $mpdf->Output('user_details.pdf', 'D');
    
    
?>