<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/principal.css">    <!--Un enlace entre este archivo y el de estilos CSS-->
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

    <div class="cont_donar">
        <div class="requisitos">
            <p>Antes de donar, debe asegurarse de cumplir con los siguientes requisitos:</p>
            <ul>
                <li>Tener entre 18 y 64 años.</li>
                <li>Pesar más de 50 kilos.</li>
                <li>No tener enfermedad crónica (diabetes, presión, etc.).</li>
                <li>No estar embarazada o amamantando.</li>
                <li>No consumir drogas.</li>
                <li>No haberse tatuado ni perforado entre 6 y 12 meses.</li>
                <li>No haber sido operado en los últimos 6 meses.</li>
                <li>No haber padecido ninguna infección viral en los últimos 7 días (gripe, angina, pulmonía).</li>
                <li>No ser persona activa sexualmente con desconocidos sin protección.</li>
            </ul>
        </div>

        <div class="cont_botones">
            <?php
                $pub_id = $_GET['id'];
                echo "<button class=\"btn_donar\" onclick=\"location.href='codigo/cod_donar.php?id=$pub_id';\">Donar</button><button class=\"btn_donar\" onclick=\"location.href='index.php';\">Cancelar</button>";
            ?>
        </div>
    </div>
</body>
</html>