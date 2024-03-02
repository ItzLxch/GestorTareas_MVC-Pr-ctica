<?php

include("../Config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Id'];
    $categoriaId = $_POST['categoriaTarea'];
    $descripcionTarea = $_POST['descripcionTarea'];


    $sqlActualizar = "UPDATE tareas_predeterminadas SET categoria_id = ?, descripcion = ? WHERE id = ?";

    if ($stmtActualizar = $conexion->prepare($sqlActualizar)) {
        $stmtActualizar->bind_param("isi", $categoriaId, $descripcionTarea, $id);

        if ($stmtActualizar->execute()) {
            echo "Tarea actualizada con éxito.";
            header("location: ../index.php");
        } else {
            echo "Error al actualizar la tarea: " . $stmtActualizar->error;
        }

        $stmtActualizar->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Método no soportado.";
}

?>
