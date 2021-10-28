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

        $consulta = "SELECT publicaciones.PUB_APELLIDO, publicaciones.PUB_NOMBRE, hospitales.HOS_NOMBRE, hospitales.HOS_DIRECC, hospitales.HOS_HORA FROM publicaciones INNER JOIN hospitales ON publicaciones.HOS_ID=hospitales.HOS_ID WHERE publicaciones.PUB_ID=$pub_id";
        if ($resultado = $conexion->query($consulta)) {
            while ($fila = $resultado->fetch_assoc()) {
                $pub_apell = $fila['PUB_APELLIDO'];
                $pub_nombr = $fila['PUB_NOMBRE'];
                $hospital = $fila['HOS_NOMBRE'];
                $hos_direcc = $fila['HOS_DIRECC'];
                $hos_hora = $fila['HOS_HORA'];
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

        $consulta1 = "UPDATE dadores SET DAS_ID=2 WHERE PUB_ID=$pub_id AND USU_ID=$usu_id";
        $consulta2 = "UPDATE publicaciones SET PUB_DADORES_CANT=PUB_DADORES_CANT-1 WHERE PUB_ID=$pub_id";
        if ($resultado1 = $conexion->query($consulta1) && $resultado2 = $conexion->query($consulta2)) {
            //Acá manda el mail
            email_aprobar($pub_apell, $pub_nombr, $hospital, $hos_direcc, $hos_hora, $usu_id, $pub_id, $usu_email);
        }
        else {
            echo "Se ha producido un error al actualizar los datos, inténtelo más tarde.";
        }   
        $resultado->free();
        $conexion->close();
    }

    function email_aprobar($pub_apell, $pub_nombr, $hospital, $hos_direcc, $hos_hora, $usu_id, $pub_id, $usu_email) {
        $asunto = "Donar es ayudar - Solicitud aprobada";
        $mensaje = "
        ¡Muchas gracias por su ayuda!<br>
        Este correo confirma que se encuentra habilitado para poder donarle a $pub_nombr $pub_apell.<br>
        Deberá presentarse con su DNI en el $hospital, $hos_direcc.<br><br>
        
        Horarios para donar: $hos_hora<br><br>
        
        Número de comprobante: $pub_id$usu_id";

        include("../email_dador.php");
    }
?>