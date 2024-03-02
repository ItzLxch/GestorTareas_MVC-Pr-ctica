<?php

include("../Config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Id'])) {
    $id = $_POST['Id'];

    $sqlEliminar = "DELETE FROM tareas_predeterminadas WHERE id = ?";

    if ($stmtEliminar = $conexion->prepare($sqlEliminar)) {
        $stmtEliminar->bind_param("i", $id);

        if ($stmtEliminar->execute()) {
            echo "Tarea eliminada con éxito.";
            header("Location: ../index.php");
        } else {
            echo "Error al eliminar la tarea: " . $stmtEliminar->error;
        }

        $stmtEliminar->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Solicitud no válida.";
}

?>
