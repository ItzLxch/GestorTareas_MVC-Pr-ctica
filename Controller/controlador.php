<?php
if (isset($_GET['var1'])) {
    $var1 = $_GET['var1'];




    if ($var1 == 1) {
        include("../Model/MReporteAdminTTareas.php");
    } 
    elseif ($var1 == 2) {
        include("../Model/MReporteAdminTUsuarios.php");
    } 
    elseif ($var1 == 3) {
        include("../Model/MReporteAdminUsuariosTarea.php");
    } 
    else {
        echo "Opción no válida";
    }
} 
?>
