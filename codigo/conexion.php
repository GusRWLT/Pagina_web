<?php
    $server = "localhost";                           //Servidor donde está alojada la BD
    $user = "id17489553_vaccarogustavo";             //Nombre de usuario del servidor
    $pass_db = ")qF-W[}cf76G[q3(";                   //Contraseña del servidor
    $database = "id17489553_donar";                  //Nombre de la BD

    $conexion = new mysqli($server, $user, $pass_db, $database);       //Establece la conexión con la DB
    if ($conexion->connect_errno) {                                 //Comprueba si hubo algún error al conectarse
        echo "Fallo al conectar a la base de datos: (" . $conexion->connect_errno . ") " . $conexion->connect_errno;
        //header("Location:error_db.php");                            //Si se produjo un error, redirije a una página de error
        exit();
    }
    $conexion->set_charset("utf8");     //Establece el estandar de codificaciones para los caracteres de la DB (es para que se vean bien las tildes y ñ)
?>