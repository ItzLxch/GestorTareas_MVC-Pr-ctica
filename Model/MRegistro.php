<?php

include("../Config/conexion.php"); // Asegúrate de tener este archivo configurado con tus datos de conexión a la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña']; // Considera encriptar esta contraseña antes de almacenarla.
    $cedula = $_POST['cedula'];

    // Validaciones básicas (podrías expandirlas según sea necesario)
    if (empty($nombre) || empty($email) || empty($contraseña) || empty($cedula)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Encriptación de la contraseña
    $contraseñaEncriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Inserción del nuevo usuario
    $sqlUsuario = "INSERT INTO usuarios (nombre, correo, contrasena, cedula) VALUES (?, ?, ?, ?)";
    if ($stmtUsuario = $conexion->prepare($sqlUsuario)) {
        $stmtUsuario->bind_param("ssss", $nombre, $email, $contraseñaEncriptada, $cedula);

        if ($stmtUsuario->execute()) {
            // Redirección al login o a una página de éxito
            header("Location: ../indexLogin.php"); // Asegúrate de ajustar esta ruta a la página de login o de éxito en tu aplicación
        } else {
            echo "Error al registrar el usuario: " . $stmtUsuario->error;
        }
        $stmtUsuario->close();
    } else {
        echo "Error al preparar la consulta de registro: " . $conexion->error;
    }

    $conexion->close();
}

?>
