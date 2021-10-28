<?php
    session_start();    //Reaunada la sesión iniciada en el archivo "cod_registro.php" para poder recibir el mensaje de error almacenado en la variable superglobal
?>

<!--Inicia HTML5-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Registro</title>
    <link rel="stylesheet" href="estilos/registro.css"/>
</head>

<body>
    <!--Cabecera de la página-->
    <header id="cabecera_principal">
        <button id="boton_header" onclick="location.href='ingreso.php';">Iniciar sesión</button>
        <button id="boton_header" onclick="location.href='registro.php';">Registrarse</button>
    </header>

    <?php 
        include("consultas.php");    //Se incluye el archivo donde están las consultas para llenar los combobox
    ?>

     
    <!--Crea un formulario con el método "post" para enviar datos de HTML a PHP-->
    <div class="registro">
    <h1>Registro</h1> 
    <form action="codigo/cod_registro.php" method="post" autocomplete="off">     

        <label for="apellido">Apellido<label><br>
        <input type="text" name="apellido" class="textbox" maxlength="50"><br><br>

        <label for="nombre">Nombre<label><br>
        <input type="text" name="nombre" class="textbox" maxlength="50"><br><br>

        <label for="dni">DNI</label><br>
        <input type="text" name="dni" class="textbox" minlength="8" maxlength="8" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))""><br><br>

        <label for="dni_tramite">N° de trámite del DNI</label><br>
        <input type="text" name="dni_tramite" class="textbox" minlength="11" maxlength="11" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))""><br><br>

        <label for="fecha_nac">Fecha de nacimiento</label><br>
        <input type="date" name="fecha_nac" class="datebox"><br><br>

        <label for="localidad">Localidad</label><br>
        <select name="localidad" class="combobox"> 
            <?php
                combo_loc();    //Llamo la función creada en el archivo "consultas.php" para cargar los datos al combobox de localidades
            ?>
        </select><br><br>

        <label for="email">Correo electrónico</label><br>
        <input type="email" name="email" class="textbox" maxlength="100"><br><br>

        <label for="tel">Teléfono</label><br>
        <input type="text" name="tel" class="textbox" maxlength="12"><br><br>

        <label for="factor">Grupo sanguíneo</label><br>
        <select name="factor" class="combobox">
            <?php
                combo_factor();     //Llamo a la función creada en el archivo "consultas.php" para cargar los datos al combobox de factores
            ?>
        </select><br><br>

        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" class="textbox" maxlength="50"><br><br>

        <label for="pass_conf">Confirmar contraseña</label><br>
        <input type="password" name="pass_conf" class="textbox" maxlength="50"><br><br>

        <input type="submit" name="registrar" class="boton" value="Registrar"><br><br>

        <!--Imprime un mensaje de error si existe-->
        <div class="alerta">
            <?php
                if (isset($_SESSION['error'])) {    //Comprueba que la variable no esté vacía
                    echo $_SESSION['error'];    //Imprime el mensaje de error
                    $_SESSION['error'] = NULL;  //Borro el contenido de la varible
                }
            ?>
        </div>
    </form>
    </div>

</body>
</html>