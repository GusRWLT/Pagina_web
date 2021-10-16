<?php
    session_start();
    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id'];
    } else {
        header("location:../ingreso.php");
        exit();
    }

    //Comprobar que todos los campos no estén vacíos
    if (!empty($_POST['apellido']) && !empty($_POST['nombre']) && !empty($_POST['dni']) && !empty($_POST['dadores'])) {
        
        $apellido = trim($_POST['apellido']);
        $nombre = trim($_POST['nombre']);
        $dni = $_POST['dni'];
        $factor = $_POST['factor'];
        $hospital = $_POST['hospital'];
        $dadores = $_POST['dadores'];
        $fecha_lim = date('Y-m-d', strtotime($_POST['fecha_lim']));

        include("../conexion.php");

        $query = "INSERT INTO publicaciones (USU_ID, PUB_APELLIDO, PUB_NOMBRE, PUB_DNI, FACTOR_ID, HOS_ID, PUB_DADORES_CANT, PUB_FECHA, PUB_FECHA_LIM, PUB_ESTADO) VALUES ('$usuario_id', '$apellido', '$nombre', $dni, $factor, $hospital, $dadores, CURDATE(), '$fecha_lim', 1)";
        if ($conexion->query($query)) {
            header("location:../index.php");
        } else {
            echo "Error: " . $query . "<b>" . $conexion->error;
        }

    } else {
        $msg_error = "Debe llenar todos los campos.";
        header("location:../crear_publi.php");
    }

    if (isset($msg_error)) {
        $_SESSION['error'] = $msg_error;
    }
?>