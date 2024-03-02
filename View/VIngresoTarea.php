<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mecánica - Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        #menu {
            background-color: #007BFF;
            padding: 10px;
            display: flex;
            justify-content: space-around;
        }

        #content {
            padding: 20px;

        }

        #footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .menu-item {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #0056b3;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        .add-button, .delete-button {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .delete-button {
            background-color: #dc3545;
        }
    </style>
</head>


<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <form action="../Model/MIngresoTareaAdmin.php" method="POST" id="formularioIngresoTareaPredeterminada">

        <div id="alertPlaceholder"></div>

        <div id="content">
            <center><h2>TAREAS </h2></center>
            
            <!-- Tabla para mostrar tareas predeterminadas existentes -->
            <table>
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("../Config/conexion.php");
                    $categorias_options = "";

                    $sqlTareas = "SELECT tp.id, c.nombre as categoria, tp.descripcion FROM tareas_predeterminadas tp INNER JOIN categorias c ON tp.categoria_id = c.id";
                    $sqlCategorias = "SELECT id, nombre  FROM categorias";

                    $resultadoTareas = $conexion->query($sqlTareas);
                    $resultadoCategorias = $conexion->query($sqlCategorias);


                    if ($resultadoTareas->num_rows > 0) {
                        while($tarea = $resultadoTareas->fetch_assoc()) {
                            echo "<tr>";
                            //echo "<td>" . $tarea["id"] . "</td>";
                            echo "<td>" . $tarea["categoria"] . "</td>";
                            echo "<td>" . $tarea["descripcion"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay tareas predeterminadas para mostrar</td></tr>";
                    }

                    if (!$resultadoCategorias) {
                        // Manejo de error, la consulta falló
                        die("Error en la consulta: " . $conexion->error);
                    }
                    
                    if ($resultadoCategorias->num_rows > 0) {
                        while ($categoria = $resultadoCategorias->fetch_assoc()) {
                            $categorias_options .= "<option value='" . $categoria['id'] . "'>" . htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                    } else {
                        $categorias_options = "<option value=''>No hay categorías disponibles</option>";
                    }

                    $conexion->close();
                    ?>
                </tbody>
            </table>
            <br>

            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-success add-button" data-bs-toggle="modal" data-bs-target="#modalIngresoTareaPredeterminada">
                    Agregar Nueva Tarea 
                </button>
            </div>

            <!-- Modal para ingreso de nueva tarea predeterminada -->
            <div class="modal fade" id="modalIngresoTareaPredeterminada" tabindex="-1" aria-labelledby="modalIngresoTareaPredeterminadaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalIngresoTareaPredeterminadaLabel">Ingreso de Nueva Tarea Predeterminada</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="categoriaTarea" class="form-label">Categoría <span class="text-danger">*</span></label>
                                <select class="form-select" id="categoriaTarea" name="categoriaTarea" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php echo $categorias_options; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionTarea" class="form-label">Descripción de la Tarea <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="descripcionTarea" name="descripcionTarea" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar Tarea </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="footer">
        <p>&copy; 2024 Gestor de Tareas. Todos los derechos reservados.</p>
    </div>
</body>

</html>
