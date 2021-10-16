<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Registro</title>
    <link rel="stylesheet" href="estilos/verificacion.css">
</head>
<body>
    <header id="cabecera_principal">
        <button id="boton_header" onclick="location.href='ingreso.php';">Iniciar sesión</button>
        <button id="boton_header" onclick="location.href='registro.php';">Registrarse</button>
    </header>

    <?php
        if (isset($_GET['email']) && isset($_GET['hash'])) {    //Comprueba que en la URL estén el email del usuario y el hash
            //Guardo los datos de la URL en variables usando el método GET
            $email = $_GET['email'];
            $hash = $_GET['hash'];

            include("conexion.php");

            $query = "SELECT USU_EMAIL, USU_ESTADO, USU_HASH FROM usuarios WHERE USU_EMAIL='".$email."' AND USU_ESTADO=1 AND USU_HASH='".$hash."'";

            if ($resultado = $conexion->query($query)) {
                if ($resultado->num_rows > 0) {
                    $query = "UPDATE usuarios SET USU_ESTADO='2' WHERE USU_EMAIL='".$email."' AND USU_ESTADO=1 AND USU_HASH='".$hash."'";

                    if ($conexion->query($query)) {
                        $msg_alerta = "<h1>¡Su cuenta ha sido activada exitosamente!</h1><h2>Ya puede iniciar sesión.</h2>";
                    } else {
                        $msg_alerta = "<h1>Se produjo un error al activar su cuenta.</h1>";
                    }
                } else {
                    $msg_alerta = "<h1>No se encontró al usuario o puede que la cuenta ya esté activa.</h1>";
                }
            } else {
                //Muestro un mensaje de error con los datos del error
                $msg_alerta = "Error: " . $query . "<b>" . $conexion->error;
            }
        } else {
            $msg_alerta = "<h1>Error: datos no proporcionados.</h1>";
        }
    ?>

    <div id="mensaje">
        <?php
            echo $msg_alerta;
        ?>
    </div>
</body>
</html>