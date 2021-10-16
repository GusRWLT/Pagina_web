<?php
    session_start();    //Si hubo una sesión activa, la reanuda, sino la inicia
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Donar es ayudar</title>
	<link rel="stylesheet" href="estilos/principal.css">    <!--Un enlace entre este archivo y el de estilos CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<!--Todo lo que se va a mostrar en la página va dentro de la etiqueta "body"-->
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

    <?php
        if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rol'])) {
            ?>
                <nav class="navegacion">
                    <button id="boton_publi" onclick="location.href='crear_publi.php'">Crear publicación</button>
                </nav>
            <?php
        }
    ?>
	
	<!--Una barra latera que contiene los enlaces externos a otros sitios de interés-->
	<aside id="enlaces_ext">
		<a title="Hemocentro" href="https://www.hemocentro.org/elegibilidad-de-donantes?gclid=CjwKCAjwieuGBhAsEiwA1Ly_nVKnu5yN23jBYR843E8Mh5UlYpG15aCVWa6jtCfFCzVrF2zbUqK9uxoCQH4QAvD_BwE"> <img  src="img/Gota invertida.png" alt="hemocentro" /></a><br>

    	<a title="Donar" href="https://www.argentina.gob.ar/salud/donarsangre"> <img src="img/Gota invertida.png" alt="Donar sangre" /></a><br>

		<a title="Donarg" href="https://www.donarg.com.ar/"> <img  src="img/Gota invertida.png" alt="Donarg" /></a><br>

		<a title="Dalevida" href="https://dalevida.org.ar/donde-donar-sangre/"> <img  src="img/Gota invertida.png" alt="Dalevida" /></a>
	</aside>

    <section>
        <?php
            include("conexion.php");

            $query = "SELECT * FROM publicaciones INNER JOIN factores INNER JOIN hospitales ON publicaciones.FACTOR_ID=factores.FACTOR_ID AND publicaciones.HOS_ID=hospitales.HOS_ID WHERE PUB_ESTADO=1";

            $sql = $conexion->query($query);
            while ($row = $sql->fetch_assoc()) {
                
                $pub_id = $row['PUB_ID'];
                $usu_id = $row['USU_ID'];
                $pub_apell = $row['PUB_APELLIDO'];
                $pub_nomb = $row['PUB_NOMBRE'];
                $pub_dni = $row['PUB_DNI'];
                $pub_factor = $row['FACTOR_DESC'];
                $pub_hosp = $row['HOS_NOMBRE'];
                $pub_cant = $row['PUB_DADORES_CANT'];
                $pub_fecha = $row['PUB_FECHA'];
                $pub_fech_lim = $row['PUB_FECHA_LIM'];

                if ($pub_cant > 1) {
                    $dadores_label = "dadores";
                }
                else {
                    $dadores_label = "dador";
                }

                ?>
                    <div id='publicaciones'>
                        <ul id='datos_publi'>
                            <li><?php echo "$pub_apell, $pub_nomb"; ?></li>
                            <li><?php echo "$pub_factor"; ?></li>
                            <li><?php echo "$pub_cant $dadores_label"; ?></li>
                            <li><?php echo "$pub_hosp"; ?></li>
                        </ul>
                        <?php
                            if (isset($_SESSION['id'])) {
                                if ($tu_id !== $usu_id) {
                                echo "
                                    <div id=\"btn_donar\">
                                        <button id=\"donar\" onclick=\"location.href='donar.php?id=$pub_id';\">Donar</button>
                                    </div>
                                ";
                                }
                            }
                        ?>

                    </div>
                <?php
            }
            $sql->free();
            $conexion->close();
        ?>
    </section>
	
</body>
</html>		
