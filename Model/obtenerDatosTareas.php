<?php
// Incluye el archivo de conexión
include("Config/conexion.php");

// Ejecuta la consulta para obtener los datos actualizados de las tareas
$sql = "SELECT COUNT(*) AS total_tareas, SUM(IF(tu.estado = 'completada', 1, 0)) AS tareas_completadas
        FROM tareas_predeterminadas tp
        INNER JOIN categorias c ON tp.categoria_id = c.id
        LEFT JOIN tareas_usuario tu ON tu.tarea_predeterminada_id = tp.id AND tu.usuario_id = $usuarioId";

$resultado = mysqli_query($conexion, $sql);

// Verifica si la consulta fue exitosa
if ($resultado) {
    // Obtiene los datos de la consulta
    $datosTareas = mysqli_fetch_assoc($resultado);

    // Devuelve los datos en formato JSON
    echo json_encode($datosTareas);
} else {
    // Si la consulta falla, devuelve un mensaje de error en formato JSON
    echo json_encode(array('error' => 'No se pudieron obtener los datos de las tareas.'));
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
