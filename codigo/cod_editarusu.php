<?php
    session_start();    //Abro una sesión en PHP para usar las variables globales de tipo SESSION
    //Verifico si no no hay un usuario conectado
    if (!isset($_SESSION['id'])) {
        header("location:../index.php");
        exit();
    }
    
    $usu_id = $_SESSION['id'];
    
    //Compruebo que los campos no estén vacíos y los guardo en variables
    if (!empty($_POST['apellido']) && !empty($_POST['nombre']) && !empty($_POST['localidad']) && !empty($_POST['email']) && !empty($_POST['tel'])) {
        $apellido = trim($_POST['apellido']);
        $nombre = trim($_POST['nombre']);
        $localidad = $_POST['localidad'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];

        include("../conexion.php");

        //Creo una consulta para actualizar los datos del usuario
        $consulta = "UPDATE usuarios SET USU_APELLIDO='$apellido', USU_NOMBRE='$nombre', LOC_ID=$localidad, USU_EMAIL='$email', USU_TEL='$tel' WHERE USU_ID=$usu_id";
        if ($resultado = $conexion->query($consulta)) {
            header("location:../index.php");
        }
        else {
            $mensaje = "Se ha producido un error, vuelva a internarlo.";
        }
    }
    else {
        $mensaje = "Debe llenar todos los campos.";
    }

    //Mando el mensaje de error al formulario de editar perfil
    if (isset($mensaje)) {
        $_SESSION['error'] = $mensaje;
        header("location:../editar_usu.php");
    }
?>