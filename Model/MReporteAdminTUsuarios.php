<?php
include("../Config/conexion.php");
include("../View/VReportesAdmin.php");


$sql = "SELECT * FROM usuarios";

$resultado = mysqli_query($conexion, $sql);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, '#', 1, 0, 'C');
$pdf->Cell(70, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(100, 10, 'Correo', 1, 0, 'C');


$pdf->Ln();

while($mostrar = mysqli_fetch_array($resultado)) {
    $pdf->Cell(20, 10, $mostrar['id'], 1, 0, 'C');
    $pdf->Cell(70, 10, $mostrar['nombre'], 1, 0, 'C');

    // Truncar el texto si es demasiado largo
    $descripcion = $mostrar['correo'];
    $max_len = 70; // Define la longitud máxima del texto
    if (strlen($descripcion) > $max_len) {
        $descripcion = substr($descripcion, 0, $max_len) . '...';
    }
    
    // Usar MultiCell en lugar de Cell
    $pdf->Cell(100, 10, $descripcion, 1);
    $pdf->Ln();
}


$pdf->Output('I');
?>
