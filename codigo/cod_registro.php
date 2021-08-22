<?php
    session_start();
    //Compruebo que los campos no estén vacíos
    if (!empty($_POST['apellido']) && !empty($_POST['nombre']) && !empty($_POST['dni']) && !empty($_POST['dni_tramite']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['pass']) && !empty($_POST['pass_conf'])) {
        //Creo variables para guardar los datos ingresados en el formulario. La función 'trim' elimina el espacio en blanco tanto por izquierda como por derecha
        $apellido = trim($_POST['apellido']);
        $nombre = trim($_POST['nombre']);
        $dni = ($_POST['dni']);
        $dni_tramite = ($_POST['dni_tramite']);
        $fecha_nac = date('Y-m-d', strtotime($_POST['fecha_nac']));     //Antes de almacenar la fecha en la variable, cambio el formato de 'día/mes/año' por 'año-mes-día' que es el que acepta la BD
        $localidad = $_POST['localidad'];
        $email = trim($_POST['email']);
        $tel = trim($_POST['tel']);
        $factor = $_POST['factor'];
        $pass = $_POST['pass'];
        $pass_conf = $_POST['pass_conf'];

        $edad = calcular_edad($fecha_nac);      //Almacena la edad calculada mediante la función "calcular_edad" en una variable
        if ($edad > 17 && $edad < 66) {   //Verifica que la edad se encuentra entre los 18 y 65 años para poder

        
            if ($pass == $pass_conf) {      //Verifico que se haya ingresado la misma contraseña en el campo de verificar contraseña
                include("../conexion.php");     //Incluyo el archivo con la conexión a la BD

                $query = "SELECT USU_ID FROM usuarios WHERE USU_DNI=$dni OR USU_TRAMIT=$dni_tramite OR USU_EMAIL='$email'";     //Almaceno una consulta SQL en una variable
                if ($resultado = $conexion->query($query)) {    //Compruebo que se haya ejecutado bien la consulta de arriba
                    if ($resultado->num_rows == 0) {    //Cuenta la cantidad de registros obtenidos por la consulta, si son igual a 0 significa que no hay usuarios con los mismos datos
                        //Procedo a guardar los datos en la BD
                        $query = "INSERT INTO usuarios (USU_APELLIDO, USU_NOMBRE, USU_DNI, USU_TRAMIT, USU_FECHA_NAC, LOC_ID, USU_EMAIL, USU_TEL, FACTOR_ID, USU_PASS, USU_ESTADO, USU_FECHA_REG, ROL_ID) VALUES ('$apellido', '$nombre', '$dni', '$dni_tramite', '$fecha_nac', '$localidad', '$email', '$tel', '$factor', '$pass', 1, CURDATE(), 2)";
                        if ($conexion->query($query)) {     //Ejecuta la consulta de arriba y comprueba que todo haya salido bien
                            //Acá tengo que envíar un mail al usuario
                            $msg_error = "Registro realizado con éxito.";
                            header("location:../registro.php");
                        } else {
                            echo "Error: " . $query . "<b>" . $conexion->error;     //Imprime un mensaje de error con su código pasa saber dónde se encuentra el problema
                        }
                    } else {
                        $msg_error = "El DNI, número de trámite o correo electrónico ya están en uso.";
                        header("location:../registro.php");
                    }
                } else {
                    echo "Error: " . $query . "<b>" . $conexion->error;
                }
                $resultado->free();     //Libero el espacio en memoria de la variable "resultado" que se usó para almacenar los resultados de las consultas
                $conexion->close();     //Cierro la conexión con la BD
            } else {
                $msg_error = "Las contraseñas no coinciden.";
                header("location:../registro.php");
            }
        } else {
            $msg_error = "Debe tener entre 18 y 65 años para poder registrarse en la web.";
            header("location:../registro.php");
        }
    } else {
        $msg_error = "Debe llenar todos los campos";
        header("location:../registro.php");
    }

    //Creo una variable superglobal para poderla transferir al formulario de registro
    if (isset($msg_error)) {
        $_SESSION['error'] = $msg_error;
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