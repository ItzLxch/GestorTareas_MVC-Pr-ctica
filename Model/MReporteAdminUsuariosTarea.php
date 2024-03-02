<?php
include("../Config/conexion.php");
include("../View/VReportesAdmin.php");

// Utilizar alias para cada columna seleccionada
$sql = "SELECT 
u.nombre AS usuario_nombre,
c.nombre AS categoria_nombre,
tu.estado AS estado
FROM usuarios u inner JOIN 
tareas_usuario tu ON u.id = tu.usuario_id
inner JOIN 
tareas_predeterminadas t ON tu.tarea_predeterminada_id = t.id
inner JOIN 
categorias c ON t.categoria_id = c.id
WHERE  tu.estado = 'completada'";

$resultado = mysqli_query($conexion, $sql);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(70, 10, 'Categoria', 1, 0, 'C');
$pdf->Cell(50, 10, 'Estado', 1, 1, 'C'); 

while($mostrar = mysqli_fetch_assoc($resultado)) {
    $pdf->Cell(50, 10, $mostrar['usuario_nombre'], 1, 0, 'C');
    $pdf->Cell(70, 10, $mostrar['categoria_nombre'], 1, 0, 'C');
    $pdf->Cell(50, 10, $mostrar['estado'], 1, 1, 'C');

}

$pdf->Output('I');
?>
