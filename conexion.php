<?php
    $hostname = "localhost";                           //Servidor donde está alojada la BD
    $username = "root";                                //Nombre de usuario de la BD
    $password = "";                                    //Contraseña de la BD
    $database = "donar";                               //Nombre de la BD

    $conexion = new mysqli($hostname, $root, $password, $database);       //Establece la conexión con la DB
    if ($conexion->connect_errno) {                                 //Comprueba si hubo algún error al conectarse
        echo "Fallo al conectar a la base de datos: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
        exit();     //Finaliza la ejecución del programa
    }
    $conexion->set_charset("utf8");     //Establece el estandar de codificaciones para los caracteres de la DB (es para que se vean bien las tildes y ñ)
?>
