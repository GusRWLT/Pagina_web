<!DOCTYPE html>
<html lang="en">
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
    <h1>Inicio de sesión</h1>
    <form name="login" action="codigo/cod_ingreso.php" method="POST">
        <input type="text" name="dni" class="textbox" placeholder="DNI"><br><br>
        <input type="text" name="pass" class="textbox" placeholder="Contraseña"><br><br>

        <input type="submit" name="ingreso" class="frm_boton" value="Ingresar">
    </form>
</body>
</html>