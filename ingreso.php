<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Inicio de sesión</title>
    <link rel="stylesheet" href="estilos/ingreso.css">
</head>
<body>
    <!--Cabecera de la página-->
    <header id="cabecera_principal">
        <button id="boton_header" onclick="location.href='ingreso.php';">Iniciar sesión</button>
        <button id="boton_header" onclick="location.href='registro.php';">Registrarse</button>
    </header>

    <!--Formulario con los campos DNI y contraseña para iniciar sesión-->
    <div id="cuadro_ingreso">
        <h1 class="titulo_login">Iniciar sesión</h1>
        <form name="login" action="codigo/cod_ingreso.php" method="POST">
            <input type="text" name="dni" class="textbox" placeholder="DNI" maxlength="8"><br><br>
            <input type="password" name="pass" class="textbox" placeholder="Contraseña" maxlength="50"><br><br>

            <input type="submit" name="ingreso" class="frm_boton" value="Ingresar"><br><br>

            <!--De existir, imprime un mensaje de error-->
            <div class="alerta">
                <?php
                    if(isset($_SESSION['error'])) {     //Comprueba si la variable superglobal tiene contenido
                        echo $_SESSION['error'];    //Muestra en pantalla el mensaje de la variable
                        $_SESSION['error'] = NULL;      //Borra el contenido de la variable
                    }
                ?>
            </div>
        </form>
    </div>
</body>
</html>