<?php
    session_start();    //Inicio una sesión para pasar variables a otros archivos
    if (!empty($_POST['dni']) && !empty($_POST['pass'])) {      //Comprueba que los campos DNI y Contraseña no estén vacíos
        include("../conexion.php");     //Incluyo el archivo de la conexión a la BD
        
        //Cargo los datos de los campos en variables
        $dni = $_POST['dni'];
        $pass = $_POST['pass'];

        //Cargo la consulta SQL en una variable
        $query = "SELECT USU_ID, USU_NOMBRE, ROL_ID FROM usuarios WHERE USU_DNI='$dni' AND USU_PASS='$pass' AND USU_ESTADO=2";
        
        if ($resultado = $conexion->query($query)) {    //Realiza la consulta y la guarda en la variable "resultado", mientras verifica que se haya ejecutado bien
            if ($resultado->num_rows > 0) {     //Cuenta el número de filas de la consulta, si son mayores que 0, significa que el usuario existe
                if ($fila = $resultado->fetch_assoc()) {       //Trae los resultados de la consulta y los guarda en un array
                    $_SESSION['id'] = $fila['USU_ID'];
                    $_SESSION['nombre'] = $fila['USU_NOMBRE'];
                    $_SESSION['rol'] = $fila['ROL_ID'];
                    header("location:../index.php");        //Redirije a la página principal
                } else {
                    $msg_error = "Se ha producido un error. Inténtelo más tarde.";
                    header("location:../ingreso.php");
                }
            } else {
                $msg_error = "No se encontraron usuarios con esos datos, o su cuenta aún no fue activada.";
                header("location:../ingreso.php");
            }
        } else {
            //echo "Error: " . $query . "<b>" . $conexion->error;
            $msg_error = "Se ha producido un error. Inténtelo más tarde.";
            header("location:../ingreso.php");
        }
        $resultado->free();     //Libera el espacio en memoria de la variable "resultado"
        $conexion->close();     //Cierra la conexión con la BD
    } else {
        $msg_error = "Debe ingresar el DNI y la contraseña.";
        header("location:../ingreso.php");
    }

    //Comprueba si la variable "msg_error" no está vacía y guarda su contenido en una variable superglobal 
    if (isset($msg_error)) {        
        $_SESSION['error'] = $msg_error;
    }
?>