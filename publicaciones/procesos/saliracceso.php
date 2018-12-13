<?php
    session_start(); 
    if (session_destroy()) {
        header('Location: http://127.0.0.1:8080/publicaciones/login.php');
    } else {
        echo "Error al destruir la sesión";
    }
?>