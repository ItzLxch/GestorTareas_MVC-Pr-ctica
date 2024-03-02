<?php

include("../Config/conexion.php"); 

session_start(); // Iniciar sesión para manejar la autenticación

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula']; 
    $contraseña = $_POST['contraseña']; 

    if (empty($cedula) || empty($contraseña)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    $sqlUsuario = "SELECT id, nombre, contrasena FROM usuarios WHERE cedula = ?";
    if ($stmtUsuario = $conexion->prepare($sqlUsuario)) {
        $stmtUsuario->bind_param("s", $cedula);

        if ($stmtUsuario->execute()) {
            $resultado = $stmtUsuario->get_result();
            
            if ($resultado->num_rows == 1) {
                $fila = $resultado->fetch_assoc();
                
                if ($cedula === 'admin' && $contraseña === $fila['contrasena']) {
                    $_SESSION['usuario_id'] = $fila['id'];
                    $_SESSION['nombre'] = $fila['nombre'];
                    $_SESSION['es_admin'] = true;
                    header("Location: ../index.php"); 

                } elseif (password_verify($contraseña, $fila['contrasena'])) {
                    $_SESSION['usuario_id'] = $fila['id'];
                    $_SESSION['nombre'] = $fila['nombre'];
                    header("Location: ../indexCli.php"); 
                } else {
                    echo "La contraseña ingresada no es correcta.";
                }
            } else {
                echo "No se encontró cuenta con la cédula proporcionada.";
            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmtUsuario->error;
        }
        $stmtUsuario->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
}

?>
