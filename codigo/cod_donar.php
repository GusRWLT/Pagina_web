<?php
    session_start();

    if (isset($_SESSION['id'])) {
        include("../conexion.php");

        $pub_id = $_GET['id'];
        $tu_id = $_SESSION['id'];

        $consulta = "INSERT INTO dadores (PUB_ID, USU_ID, DAD_FECHA, DAS_ID) values ($pub_id, $tu_id, CURDATE(), 1)";

        if ($conexion->query($consulta)) {
            header("location:../donar_exito.php");
        }
        else {
            echo "Se ha producido un error." . $conexion->error;
        }
    }
    else {
        header("location:../index.php");
    }

?>