<?php
session_start();
include("../Config/conexion.php");

// Verificar si se accede directamente al script sin un método POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Acceso denegado.";
    exit;
}

$usuarioId = $_SESSION['usuario_id'] ?? null;
if ($usuarioId === null) {
    echo "No se ha iniciado sesión.";
    exit;
}

// Preparar la consulta SQL para insertar o actualizar
$sql = "INSERT INTO tareas_usuario (usuario_id, tarea_predeterminada_id, estado) 
        VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE estado=VALUES(estado)";
$stmt = $conexion->prepare($sql);

// Suponiendo que todas las tareas deben establecerse en 'pendiente' primero
$conexion->query("UPDATE tareas_usuario SET estado = 'pendiente' WHERE usuario_id = $usuarioId");

foreach ($_POST['tareas'] as $tareaId => $estado) {
    // Si el checkbox está marcado, recibimos 'on', de lo contrario 'off'
    $estadoFinal = ($estado === 'on') ? 'completada' : 'pendiente';
    $stmt->bind_param("iis", $usuarioId, $tareaId, $estadoFinal);
    $stmt->execute();
}

$stmt->close();
$conexion->close();

echo "Tareas actualizadas correctamente.";
header("Location: ../indexCli.php"); 

?>
