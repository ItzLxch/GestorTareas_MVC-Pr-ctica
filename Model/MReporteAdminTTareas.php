<?php
include("../Config/conexion.php");
include("../View/VReportesAdmin.php");


$sql = "SELECT c.nombre, t.descripcion FROM tareas_predeterminadas as t inner join categorias as c on  c.id = t.categoria_id";

$resultado = mysqli_query($conexion, $sql);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Categoria', 1, 0, 'C');
$pdf->Cell(120, 10, 'Descripcion', 1, 0, 'C');

$pdf->Ln();

while($mostrar = mysqli_fetch_array($resultado)) {
    $pdf->Cell(70, 20, $mostrar['nombre'], 1, 0, 'C');

    // Truncar el texto si es demasiado largo
    $descripcion = $mostrar['descripcion'];
    $max_len = 90; // Define la longitud máxima del texto
    if (strlen($descripcion) > $max_len) {
        $descripcion = substr($descripcion, 0, $max_len) . '...';
    }
    
    // Usar MultiCell en lugar de Cell
    $pdf->MultiCell(120, 10, $descripcion, 1);
    $pdf->Ln();
}


$pdf->Output('I');
?>
