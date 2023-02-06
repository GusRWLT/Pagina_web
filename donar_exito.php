<?php
    session_start();
?>

<!--Inicio de HTML5-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/verificacion2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--Cabecera, contiene los botones de registro e inicio de sesión-->
	<header id="cabecera_principal">
        <?php
            if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rol'])) {   //Verifica que la variable superglobal "$_SESSION['id']" no esté vacía
                $tu_id = $_SESSION['id'];
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
                    <a href="#Perfil">Editar perfil</a>
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
    <!--Mensaje que se muestra después de solicitar donar en una publicación-->
    <div id="mensaje">
        <h1>¡Muchas gracias por ayudar!</h1>
        <h2>Tu solicitud para poder donar está siendo evaluada por un especialista.</h2>
        <p>Recibirás un correo electrónico a la brevedad notificándote de tu situación. Por favor, tenga paciencia.</p>
        <button class="btn_volver" onclick="location.href='index.php';">Volver</button>  <!--Botón para volver a la página de inicio-->
    </div>
</body>
</html>