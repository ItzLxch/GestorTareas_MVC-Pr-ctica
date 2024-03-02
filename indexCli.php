<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal - Cliente</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">


    <style>
 body, html {
  height: 100%;
  margin: 0;
}

.bg-image {
  background-image: url('img/arq2.jpg'); 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
  height: 100%;
  width: 100%;
  overflow: hidden;
  filter: blur(5px);
  -webkit-filter: blur(5px);
}
  

.bg-blur {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-image: url('img/arq1.jpg'); /* Cambia esto por la ruta a tu imagen */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(5px);
        -webkit-filter: blur(5px);
    }

    .content-container {
        position: relative;
        background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con un poco de transparencia */
        overflow: auto;
        height: 100%;
    }

</style>

</head>
<body>

<div class="bg-blur"></div>

<div class="content-container">
    <center> <h1>Gestor de Tareas</h1></center>
    <form id="tareasForm" method="post" action="Model/MActualizarEstadoTarea.php">

    <section class="vh-100" >
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">

                            <?php
                            session_start();
                            include("Config/conexion.php");

                            $usuarioId = $_SESSION['usuario_id'] ?? 0;

                            // Consulta para obtener las tareas y su estado
                            $sql = "SELECT tp.id, tp.descripcion, c.nombre AS categoria_nombre, IFNULL(tu.estado, 'pendiente') AS estado
                                    FROM tareas_predeterminadas tp
                                    INNER JOIN categorias c ON tp.categoria_id = c.id
                                    LEFT JOIN tareas_usuario tu ON tu.tarea_predeterminada_id = tp.id AND tu.usuario_id = $usuarioId
                                    ORDER BY c.nombre, tp.id";
                            $resultado = mysqli_query($conexion, $sql);

                            $tareasPorCategoria = [];
                            
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                $tareasPorCategoria[$fila['categoria_nombre']][] = $fila;
                            }

                            foreach ($tareasPorCategoria as $categoria => $tareas) {
                                echo '<h6>' . htmlspecialchars($categoria) . '</h6>';
                                echo '<div class="progress mb-2" style="height: 20px;">';
                                echo '<div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>';
                                echo '</div>';
                                echo '<ul id="categoria_' . htmlspecialchars(str_replace(' ', '_', $categoria)) . '" class="list-group mb-4">';
                                
                                foreach ($tareas as $tarea) {
                                    $checked = $tarea['estado'] == 'completada' ? 'checked' : '';
                                    $estadoTexto = $tarea['estado'] == 'completada' ? 'Completada' : 'Pendiente';
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                    echo htmlspecialchars($tarea['descripcion']);
                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input tarea-checkbox" type="checkbox" name="tareas[' . $tarea['id'] . ']" id="tarea_' . $tarea['id'] . '" ' . $checked . ' data-categoria="' . htmlspecialchars($categoria) . '">';
                                    echo '<label class="form-check-label" for="tarea_' . $tarea['id'] . '">' . $estadoTexto . '</label>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                                
                                

                                
                                
                                echo '</ul>';
                            }
                            ?>

                            <h6>Total</h6>
                            <div id="progress_total" class="progress" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <br>
                            <center><button type="submit" id="enviarTareasBtn" class="btn btn-primary">Guardar Tareas Completadas</button></center>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    </form>
    </div>

    <!-- JavaScript para manejar las barras de progreso -->
    <script>
$(document).ready(function() {
    // Función para actualizar el progreso de una categoría específica
    function actualizarProgresoPorCategoria(categoria) {
        var selectorCategoria = '#categoria_' + categoria.replace(/\s+/g, '_');
        var totalTareasCategoria = $(selectorCategoria + ' .tarea-checkbox').length;
        var tareasCompletadasCategoria = $(selectorCategoria + ' .tarea-checkbox:checked').length;
        var porcentajeCompletadoCategoria = (tareasCompletadasCategoria / Math.max(1, totalTareasCategoria)) * 100;
        $(selectorCategoria).prev('.progress').find('.progress-bar')
            .css('width', porcentajeCompletadoCategoria + '%')
            .attr('aria-valuenow', porcentajeCompletadoCategoria)
            .text(porcentajeCompletadoCategoria.toFixed(2) + '%');
    }

    // Función para actualizar el progreso total de todas las tareas
    function actualizarProgresoTotal() {
        var totalTareas = $('.tarea-checkbox').length;
        var totalTareasCompletadas = $('.tarea-checkbox:checked').length;
        var porcentajeCompletadoTotal = (totalTareasCompletadas / Math.max(1, totalTareas)) * 100;
        $('#progress_total .progress-bar')
            .css('width', porcentajeCompletadoTotal + '%')
            .attr('aria-valuenow', porcentajeCompletadoTotal)
            .text(porcentajeCompletadoTotal.toFixed(2) + '%');
    }

    // Evento change para los checkboxes
    $(document).on('change', '.tarea-checkbox', function() {
        var categoria = $(this).data('categoria');
        actualizarProgresoPorCategoria(categoria);
        actualizarProgresoTotal();
    });

    // Inicialización de las barras de progreso al cargar la página
    $('.list-group').each(function() {
        var categoria = $(this).attr('id').replace('categoria_', '').replace(/_/g, ' ');
        actualizarProgresoPorCategoria(categoria);
    });
    actualizarProgresoTotal();
});
</script>


