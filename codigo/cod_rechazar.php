<?php
    session_start();
    /*
    if (isset($_SESSION['rol'])) {
        if ($_SESSION['rol'] == 1) {
            header("location:../index.php");
            exit();
        }
    }
    else {
        header("location:../index.php");
        exit();
    }
    */

    //Compruebo que en la URL estén los ID
    if (isset($_GET['usu_id']) && isset($_GET['pub_id'])) {
        $usu_id = $_GET['usu_id'];
        $pub_id = $_GET['pub_id'];

        include("../conexion.php");

        $consulta = "SELECT publicaciones.PUB_APELLIDO, publicaciones.PUB_NOMBRE FROM publicaciones WHERE publicaciones.PUB_ID=$pub_id";
        if ($resultado = $conexion->query($consulta)) {
            while ($fila = $resultado->fetch_assoc()) {
                $pub_apell = $fila['PUB_APELLIDO'];
                $pub_nombr = $fila['PUB_NOMBRE'];
            }
            $consulta = "SELECT USU_EMAIL FROM usuarios WHERE USU_ID=$usu_id";
            if ($resultado = $conexion->query($consulta)) {
                while ($fila = $resultado->fetch_assoc()) {
                    $usu_email = $fila['USU_EMAIL'];
                }
            }
            else {
                echo "Error al realizar la consulta 2.";
                exit();
            }
        }
        else {
            echo "Error al realizar la consulta 1.";
            exit();
        }

        $consulta = "UPDATE dadores SET DAS_ID=2 WHERE PUB_ID=$pub_id AND USU_ID=$usu_id";
        if ($resultado = $conexion->query($consulta)) {
            //Acá manda el mail
            email_aprobar($pub_apell, $pub_nombr, $usu_email);
        }
        else {
            echo "Se ha producido un error al actualizar los datos, inténtelo más tarde.";
        }   
        $resultado->free();
        $conexion->close();
    }

    function email_aprobar($pub_apell, $pub_nombr, $usu_email) {
        $asunto = "Donar es ayudar - Solicitud rechazada";
        $mensaje = "
        Lamentamos informarle que no fue aprobada su solicitud para donarle a $pub_nombr $pub_apell.<br>
        Por favor, lea atentamente las condiciones para poder donar.";

        include("../email_dador.php");
    }
?>