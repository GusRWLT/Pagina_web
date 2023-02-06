<?php
    session_start();

    //Guardo la fecha actual (zona horaria de Argentina) en una variable
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha_min = date("Y-m-d");
?>

<!--Inicio de HTML5-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Crear publicación</title>
    <link rel="stylesheet" href="estilos/registro.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!--Cabecera de la página-->
    <header id="cabecera_principal">
        <?php
            if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rol'])) {   //Verifica que la variable superglobal "$_SESSION['id']" no esté vacía
                if ($_SESSION['rol'] == 1) {
                    echo "<div class='user'>¡Hola, <b>" . $_SESSION['nombre'] . "</b>[admin]!<span class='a'><a href='codigo/cerrar_sesion.php'><i class='fa fa-sign-out'></i></a></span></div>";
                } else {
                    echo "<div class='user'>¡Hola, <b>" . $_SESSION['nombre'] . "</b>!<span class='a'><a href='codigo/cerrar_sesion.php'><i class='fa fa-sign-out'></i></a></span></div>";  //Si no lo está, muestra dentro de la cabecera el siguiente mensaje, con su correspondiente etiqueta HTML
                }
                
            } else {    //Si está vacía, significa que no hay ningún usuario conectado, así que muestra en pantalla una cabecera estandar con sus botones de registro e inicio de sesión
                ?>
                    <button id="boton_header" onclick="location.href='ingreso.php';">Iniciar sesión</button>
                    <button id="boton_header" onclick="location.href='registro.php';">Registrarse</button>	     <!--Una etiqueta button con un poco de JavaScript para crear un enlace hacia otro documento-->
                <?php
            }
        ?>		
    </header>

    <!--Barra de navegación-->
    <?php
        if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rol'])) {
            ?>
                <nav class="navegacion">
                    <a href="index.php">Inicio</a>
                    <a href="editar_usu.php">Editar perfil</a>
                    <a href="mispublis.php">Mis publicaciones</a>
                    <a href="crear_publi.php">Crear publicación</a>
                    <?php
                        if ($_SESSION['rol'] != 2) {
                            echo "<a href='listadadores.php'>Aceptar dadores</a>";
                        }
                    ?>
                </nav>
            <?php
        }
    ?>

    <?php 
        include("consultas.php");    //Se incluye el archivo donde se realizan las consultas para llenar los combobox
    ?>

     
    <!--Crea un formulario con el método "post" para enviar datos de HTML a PHP-->
    <div class="registro">
    <h1>Crear publicación</h1> 
    <form action="codigo/cod_publi.php" method="post" autocomplete="off">     

        <label for="apellido">Apellido del paciente<label><br>
        <input type="text" name="apellido" class="textbox" maxlength="50"><br><br>

        <label for="nombre">Nombre del paciente<label><br>
        <input type="text" name="nombre" class="textbox" maxlength="50"><br><br>

        <label for="dni">DNI del paciente</label><br>
        <input type="text" name="dni" class="textbox" minlength="8" maxlength="8" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))""><br><br>

        <label for="factor">Grupo sanguíneo del paciente</label><br>
        <select name="factor" class="combobox">
            <?php
                combo_factor();     //Llamo a la función creada en el archivo "consultas.php" para cargar los datos al combobox de factores
            ?>
        </select><br><br>
        
        <label for="hospital">Hospital</label><br>
        <select name="hospital" class="combobox">
            <?php
                combo_hospital();     //Llamo a la función creada en el archivo "consultas.php" para cargar los datos al combobox de factores
            ?>
        </select><br><br>

        <label for="dadores">Dadores requeridos</label><br>
        <input type="number" name="dadores" class="textbox" min="1" max="15"><br><br>

        <label for="fecha_lim">Fecha límite</label><br>
        <input type="date" name="fecha_lim" class="datebox" min="<?php echo $fecha_min;?>"><br><br>

        <input type="submit" name="crear" class="boton" value="Crear"><br><br>

        <!--Imprime un mensaje de error traido en la variable superglobal SESSION-->
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
