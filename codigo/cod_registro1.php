<?php
    session_start();    //Iniciamos una sesión en php para poder usar las variables de tipo SESSION

    //Me fijo si los campos están vacíos
    if (empty($_POST['apellido']) || empty($_POST['nombre']) || empty($_POST['dni']) || empty($_POST['dni_tramite']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['pass']) || empty($_POST['pass_conf'])) {
        $_SESSION['msj'] = "Debe llenar todos los campos.";
        header("location:../registro.php");
        exit();
    }

    $apellido = trim($_POST['apellido']);
    $nombre = trim($_POST['nombre']);
    $dni = $_POST['dni'];
    $dni_tramite = $_POST['dni_tramite'];
    $fecha_nac = $_POST['fecha_nac'];    
    $localidad = $_POST['localidad'];
    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);
    $factor = $_POST['factor'];
    $pass = $_POST['pass'];
    $pass_conf = $_POST['pass_conf'];

    //Guardo en una viariable la edad calculada mediante la función "calcular_edad"
    $edad = calcular_edad($fecha_nac);

    //Verifica que la edad del usuario sea menor a 18 o mayor a 65
    if ($edad < 18 || $edad > 65) {
        $_SESSION['msj'] = "Debe tener entre 18 y 65 años para poder registrarse en la web.";
        header("location:../registro.php");
        exit();
    }

    //Verifica que las contraseñas ingresadas en ambos campos no coincidan
    if ($pass != $pass_conf) {
        $_SESSION['msj'] = "Las contraseñas no coinciden.";
        header("location:../registro.php");
        exit();
    }





    //Una función para calcular la edad en base a la fecha de nacimiento
    function calcular_edad($fecha_nac) {
        list($anio, $mes, $dia) = explode("-", $fecha_nac);
        $anio_dife = date("Y") - $anio;
        $mes_dife = date("m") - $mes;
        $dia_dife = date("d") - $dia;
        if ($dia_dife < 0 || $mes_dife < 0)
            $anio_dife--;
        return $anio_dife;
    }
?>