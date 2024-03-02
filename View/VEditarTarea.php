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

    <form action="../Model/MEditarTareaAdmin.php" method="POST" id="formularioActualizarServicio">
        <div id="alertPlaceholder"></div>
        <div id="content">
            <center><h2>EDITAR TAREA</h2></center>
            
            <!-- Formulario para editar tarea existente -->
            <?php
            include("../Config/conexion.php");

            // Asumiendo que 'id' ha sido enviado a través de GET o POST
            $id = isset($_GET['Id']) ? $_GET['Id'] : (isset($_POST['Id']) ? $_POST['Id'] : null);

            if ($id !== null) {
                $id = $conexion->real_escape_string($id);

                // Prepara tu consulta SQL para obtener la tarea específica
                $sqlTarea = "SELECT * FROM tareas_predeterminadas WHERE id = '$id'";
                $resultadoTarea = $conexion->query($sqlTarea);

                if ($resultadoTarea->num_rows > 0) {
                    $filaTarea = $resultadoTarea->fetch_assoc();

                    // Obtener todas las categorías para el combobox
                    $sqlCategorias = "SELECT * FROM categorias ORDER BY nombre";
                    $resultadoCategorias = $conexion->query($sqlCategorias);
                    ?>
                    
                    <!-- Aquí empieza el formulario con los datos de la tarea -->
                    <div class="mb-3">
                        <label for="categoriaTarea" class="form-label">Categoría <span class="text-danger">*</span></label>
                        <select class="form-select" id="categoriaTarea" name="categoriaTarea" required>
                            <option value="">Seleccione una categoría</option>
                            <?php 
                            while ($filaCategoria = $resultadoCategorias->fetch_assoc()) {
                                $selected = ($filaCategoria['id'] == $filaTarea['categoria_id']) ? 'selected' : '';
                                echo "<option value='{$filaCategoria['id']}' {$selected}>".htmlspecialchars($filaCategoria['nombre'])."</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionTarea" class="form-label">Descripción de la Tarea <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="descripcionTarea" name="descripcionTarea" rows="3" required><?php echo htmlspecialchars($filaTarea['descripcion']); ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="<?php echo htmlspecialchars($id); ?>"> <!-- Envía el ID de la tarea a actualizar -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
                    </div>
                    <!-- Aquí termina el formulario -->
                    <?php
                } else {
                    echo "La tarea no existe.";
                }
            } else {
                echo "ID no proporcionado. Por favor, regrese y vuelva a intentarlo.";
            }
            $conexion->close();
            ?>
        </div>
    </form>

    <div id="footer">
        <p>&copy; 2024 Gestor de Tareas. Todos los derechos reservados.</p>
    </div>
</body>





</html>
