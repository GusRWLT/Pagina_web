<?php
    session_start();

    $pub_id = $_POST['pub_id'];
    if (!empty($_POST['apellido']) && !empty($_POST['nombre']) && !empty($_POST['dadores'])) {
        $apellido = trim($_POST['apellido']);
        $nombre = trim($_POST['nombre']);
        $dadores = $_POST['dadores'];
        $fecha = $_POST['fecha_lim'];

        include("../conexion.php");

        $consulta = "UPDATE publicaciones SET PUB_APELLIDO='$apellido', PUB_NOMBRE='$nombre', PUB_DADORES_CANT=$dadores, PUB_FECHA_LIM='$fecha' WHERE PUB_ID=$pub_id";
        if ($resultado = $conexion->query($consulta)) {
            header("location:../mispublis.php");
        }
        else {
            $mensaje = "Se ha producido un error, vuelva a internarlo.";
        }
    }
    else {
        $mensaje = "Debe llenar todos los campos.";
    }

    if (isset($mensaje)) {
        $_SESSION['error'] = $mensaje;
        header("location:../editar_publi.php?pub_id=$pub_id");
    }
?>