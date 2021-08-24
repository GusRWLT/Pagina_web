<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Inicio de sesión</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            text-align: center;
        }

        .textbox {
            width: 230px;
            height: 23px;
        }

        h1 {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header id="cabecera_principal">
        <button id="boton_header" onclick="location.href='ingreso.php';">Iniciar sesión</button>
        <button id="boton_header" onclick="location.href='registro.php';">Registrarse</button>
    </header>

    <h1 class="titulo_login">Iniciar sesión</h1>
    <form name="login" action="codigo/cod_ingreso.php" method="POST">
        <input type="text" name="dni" class="textbox" placeholder="DNI" maxlength="8"><br><br>
        <input type="password" name="pass" class="textbox" placeholder="Contraseña" maxlength="50"><br><br>

        <input type="submit" name="ingreso" class="frm_boton" value="Ingresar"><br><br>

        <?php
            session_start();
            if(isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                $_SESSION['error'] = NULL;
            }
        ?>
    </form>
</body>
</html>
