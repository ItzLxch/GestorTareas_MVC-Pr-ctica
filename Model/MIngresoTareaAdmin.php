<?php

include("../Config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoriaId = $_POST['categoriaTarea'];
    $descripcionTarea = $_POST['descripcionTarea'];

    if (empty($categoriaId)) {
        echo "Por favor, seleccione una categoría.";
        exit;
    }

    

    // Paso 2: Insertar la nueva tarea predeterminada usando el ID de categoría
    $sqlTarea = "INSERT INTO tareas_predeterminadas (categoria_id, descripcion) VALUES (?, ?)";
    if ($stmtTarea = $conexion->prepare($sqlTarea)) {
        $stmtTarea->bind_param("is", $categoriaId, $descripcionTarea);
        if ($stmtTarea->execute()) {
            header("location: ../View/VIngresoTarea.php");
        } else {
            echo "Error al insertar la tarea predeterminada: " . $stmtTarea->error;
        }
        $stmtTarea->close();
    } else {
        echo "Error al preparar la consulta de tarea: " . $conexion->error;
    }

    $conexion->close();
}

?>
