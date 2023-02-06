<?php
    session_start();
    $_SESSION['id'] = NULL;
    $_SESSION['nombre'] = NULL;
    $_SESSION['rol'] = NULL;
    header("location:../index.php");
?>