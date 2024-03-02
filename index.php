<?php
header("Location: indexRegistro.php");
exit;
?>

<!DOCTYPE html>
<html  style="background-color: #e2d5de;" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
<center>
    <h1 class="mb-3">Gestor de Tareas</h1>
    <hr>
    <div class="btn-group" role="group" aria-label="Botones de Reporte">
        <a href="Controller/Controlador.php?var1=5" class="btn btn-primary">Ver Total Tareas Existentes</a>
        <a href="Controller/Controlador.php?var1=5" class="btn btn-primary">Ver Total Usuarios Registrados</a>
        <a href="Controller/Controlador.php?var1=5" class="btn btn-primary">Tareas Completadas por Usuario</a>
    </div>
</center>





    <section class="vh-100" >
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
      
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">

      
                  <?php
                  include("Config/conexion.php");
                  // Cambio en la consulta para unir las tareas predeterminadas con sus categorías
                  $sql = "SELECT tp.id, tp.descripcion, c.nombre AS categoria_nombre FROM tareas_predeterminadas tp INNER JOIN categorias c ON tp.categoria_id = c.id ORDER BY c.nombre, tp.id";
                  $resultado = mysqli_query($conexion, $sql);

                  
                
                  
                  $currentCategory = null;
                  while($fila = mysqli_fetch_assoc($resultado)) {
                    // Solo empezar una nueva lista si la categoría cambia
                    if ($currentCategory !== $fila['categoria_nombre']) {
                        if ($currentCategory !== null) {
                            // Cerrar la lista anterior si no es la primera vez
                            echo '</ul>';
                        }
                        // Encabezado de la categoría
                        echo '<h6>' . htmlspecialchars($fila['categoria_nombre']) . '</h6>';
                        echo '<ul class="list-group mb-3">';
                        $currentCategory = $fila['categoria_nombre'];
                    }
                    // Listar la descripción de la tarea
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    echo recortarTexto(htmlspecialchars($fila['descripcion']), 10); // Limita a 20 palabras

                    
                    // Botones de editar y eliminar para cada tarea
                    echo '<div >';
                
                    // Formulario de editar
                    echo '<form action="View/VEditarTarea.php" method="POST" style="display: inline-block; margin-right: 5px;">';
                    echo '<input type="hidden" name="Id" value="' . htmlspecialchars($fila['id']) . '">';
                    echo '<button class="btn btn-primary btn-sm" type="submit" title="Editar tarea"> ';
                    echo '<i class="fas fa-pencil-alt"></i>';
                    echo '</button>';
                    echo '</form>';
                
                    // Formulario de eliminar
                    echo '<form action="Model/MEliminarTareaAdmin.php" method="POST" style="display: inline-block;">';
                    echo '<input type="hidden" name="Id" value="' . htmlspecialchars($fila['id']) . '">';
                    echo '<button class="btn btn-danger btn-sm" type="submit" title="Eliminar tarea" onclick="return confirm(\'¿Estás seguro de que deseas eliminar esta tarea?\');">';
                    echo '<i class="fas fa-trash-alt"></i>';
                    echo '</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</li>';
                }
                // No olvides cerrar la última lista si hay al menos una categoría
                if ($currentCategory !== null) {
                    echo '</ul>';
                }

                function recortarTexto($texto, $limite=10) {
                  $palabras = explode(' ', $texto, $limite + 1);
                  if (count($palabras) > $limite) {
                      array_pop($palabras);
                      return implode(' ', $palabras) . '...';
                  }
                  return $texto;
              }
                  ?>
<center >
    <button type="button" class="btn btn-primary btn-sm ms-2" onclick="window.location.href='View/VIngresoTarea.php';">Agregar Tarea</button>

</center>

                </div>
              </div>
            </div>
          </div>
        </div>
        
      </section>

      </div>

</body>




</html>