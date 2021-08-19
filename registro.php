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

    <?php 
        include("conexion.php");    //Se incluye el archivo donde se realizó la conexión con la BD a este mismo archivo
    ?>

    <header>

    </header>

    <h1>Registro</h1>  

    <form method="post" autocomplete="off">     <!--Crea un formulario con el método "post" para enviar datos de HTML a PHP-->

        <label for="apellido">Apellido<label><br>
        <input type="text" name="apellido" class="textbox" maxlength="50"><br><br>

        <label for="nombre">Nombre<label><br>
        <input type="text" name="nombre" class="textbox" maxlength="50"><br><br>

        <label for="dni">DNI</label><br>
        <input type="text" name="dni" class="textbox" maxlength="8" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))""><br><br>

        <label for="dni_tramite">N° de trámite</label><br>
        <input type="text" name="dni_tramite" class="textbox" maxlength="11" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))""><br><br>

        <label for="fecha_nac">Fecha de nacimiento</label><br>
        <input type="date" name="fecha_nac" class="datebox"><br><br>

        <label for="localidad">Localidad</label><br>
        <select name="localidad" class="combobox"> 
            <?php
                $query = "SELECT * FROM localidades";
                $sql = mysqli_query($conexion, $query);  //Crea una variable de nombre "sql" y le asigna el resultado de la consulta SQL SELECT
                while ($row = $sql->fetch_assoc()) {    //Inicia un bucle while recorriendo cada registro de la consulta, almacenándolas en la variable "row" (fila)
                    echo "<option value=" . $row['LOC_ID'] . ">" . $row['LOC_DESC'] . "</option>";  //Imprime un código HTML creando las opciones del combobox con los datos obtenidos de la BD (los puntos sirven para concatenar strings y datos)
                }
            ?>
        </select><br><br>

        <label for="email">Correo electrónico</label><br>
        <input type="email" name="email" class="textbox" maxlength="100"><br><br>

        <label for="tel">Teléfono</label><br>
        <input type="text" name="tel" class="textbox" maxlength="20"><br><br>

        <label for="factor">Grupo sanguíneo</label><br>
        <select name="factor" class="combobox">
            <?php
                //Lo mismo que el código de arriba, pero esta vez para los factores
                $query = "SELECT * FROM factores";
                $sql = mysqli_query($conexion, $query);
                while ($row = $sql->fetch_assoc()) {
                    echo "<option value=" . $row['FACTOR_ID'] . ">" . $row['FACTOR_DESC'] . "</option>";
                }
            ?>
        </select><br><br>

        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" class="textbox" maxlength="50"><br><br>

        <label for="pass_conf">Confirmar contraseña</label><br>
        <input type="password" name="pass_conf" class="textbox" maxlength="50"><br><br>

        <input type="submit" name="registrar" class="boton" value="Registrar">
    </form>

    <?php
        if (isset($_POST['registrar'])) {   //Se utiliza la función "isset" para detectar si se presionó el botón "registrar"
            //"strlen" es una función que cuenta la cantidad de caracteres. Se usa para detectar que haya contenido en los campos
            if (strlen($_POST['apellido']) >= 1 && strlen($_POST['nombre']) >= 1 && strlen($_POST['dni']) >= 1 && strlen($_POST['dni_tramite']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['tel']) >= 1 && strlen($_POST['pass']) >= 1 && strlen($_POST['pass_conf']) >= 1) {
                //Creo variables para guardar los datos ingresados en el formulario. La función 'trim' elimina el espacio en blanco tanto por izquierda como por derecha
                $apellido = trim($_POST['apellido']);
                $nombre = trim($_POST['nombre']);
                $dni = trim($_POST['dni']);
                $dni_tramite = trim($_POST['dni_tramite']);
                $fecha_nac = date('Y-m-d', strtotime($_POST['fecha_nac']));     //Antes de almacenar la fecha en la variable, cambio el formato de 'día/mes/año' por 'año-mes-día' que es el que acepta la BD
                $localidad = $_POST['localidad'];
                $email = trim($_POST['email']);
                $tel = trim($_POST['tel']);
                $factor = $_POST['factor'];
                $pass = $_POST['pass'];
                $pass_conf = $_POST['pass_conf'];

                if ($pass == $pass_conf) {      //Verifico que se haya ingresado la misma contraseña en el campo de verificar contraseña
                    $query = "INSERT INTO usuarios(USU_APELLIDO, USU_NOMBRE, USU_DNI, USU_TRAMIT, USU_FECHA_NAC, LOC_ID, USU_EMAIL, USU_TEL, FACTOR_ID, USU_PASS, USU_ESTADO, USU_FECHA_REG, ROL_ID) VALUES('$apellido', '$nombre', '$dni', '$dni_tramite', '$fecha_nac', '$localidad', '$email', '$tel', '$factor', '$pass', 1, CURDATE(), 2)";
                    $resultado = mysqli_query($conexion, $query);
                    
                    if($resultado) {
                        ?>
                            <br><p class='confir'>Registrado con éxito.</p>
                        <?php
                    } else {
                        ?>
                            <br><p class='alerta'>Error al registrarse.</p>
                        <?php
                    }
                } else {
                    ?>
                        <br><p class='alerta'>Verifique que haya ingresado bien las dos veces su contraseña.</p>
                    <?php
                }
            } else {
                ?>
                    <br><p class='alerta'>Debe completar todos los campos.</p>
                <?php
            }
        }
    ?>
</body>
</html>