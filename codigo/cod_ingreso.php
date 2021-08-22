<?php
    if (!empty($_POST['dni']) && !empty($_POST['pass'])) {
        include ("../conexion.php");

        $dni = $_POST['dni'];
        $pass = $_POST['pass'];

        $query = "SELECT USU_PASS FROM usuarios WHERE USU_DNI='" . $dni . "' AND USU_PASS='" . $pass . "'";
        $result = mysqli_query($conexion, $query);

        if ($result) {      //Comprueba si la consulta se ejecutó correctamente
            $row = mysqli_num_rows($result);    //Cuenta el número de filas seleccionadas de la consulta select y las guarda en la variable 'row'
            if ($row) {     //Comprueba si encontró al menos una fila, o sea si encontró un usuario con esos datos (DNI y contraseña)
                session_start();       //Uso la función "session_start" para iniciar sesión
                $_SESSION['user'] = $_POST['dni'];      //Guardo el campo dni en la sesión actual como una variable superglobal
                header("location:../index.php");    //Redirije a la página principal
            } else {
                $msg_error = "Error al iniciar sesión: compruebe que el usuario y la contraseña estén correctos.";      //Guardo un mensaje de error en una variable para luego mostrarla en la página de inicio de sesión
                header("location:../ingreso.php");      //Me redirije de vuelta a la página de inicio de sesión
            }
            mysqli_free_result($result);    //Libera la memoria asociada al resultado
        } else {
            $msg_error = "Se ha producido un error. Inténtelo más tarde.";
            header("location:../ingreso.php");
        }
        mysqli_close($conexion);     //Cierro la conexión con la BD
    } else {
        $msg_error = "Debe completar todos los campos.";
        header("location:../ingreso.php");
    }
?>