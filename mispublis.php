<?php
    session_start();
    //Si un usuario está conectado, guarda su id y rol en variables. Si no lo está, lo manda a la página de inicio
    if (isset($_SESSION['id'])) {
        $usu_id = $_SESSION['id'];
        $usu_rol = $_SESSION['rol'];
    }
    else {
        header("location:index.php");
        exit();
    }
?>

<!--Inicio HTML5-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Administrar publicaciones</title>
    <link rel="stylesheet" href="estilos/principal.css">    <!--Un enlace entre este archivo y el de estilos CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--Cabecera de la página-->
    <header id="cabecera_principal">
        <?php
            if ($usu_rol == 1) {
                echo "<div class='user'>¡Hola, <b>" . $_SESSION['nombre'] . "</b>[admin]!<span class='a'><a href='codigo/cerrar_sesion.php'><i class='fa fa-sign-out'></i></a></span></div>";
            } 
            else {
                echo "<div class='user'>¡Hola, <b>" . $_SESSION['nombre'] . "</b>!<span class='a'><a href='codigo/cerrar_sesion.php'><i class='fa fa-sign-out'></i></a></span></div>";  //Si no lo está, muestra dentro de la cabecera el siguiente mensaje, con su correspondiente etiqueta HTML
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

    <!--Contenido principal donde se muestran todas las publicaciones creadas por el usuario -->
    <section>
        <?php
            include("conexion.php");

            $consulta = "SELECT publicaciones.PUB_ID, publicaciones.PUB_APELLIDO, publicaciones.PUB_NOMBRE, publicaciones.PUB_DADORES_CANT, factores.FACTOR_DESC, hospitales.HOS_NOMBRE FROM publicaciones INNER JOIN factores INNER JOIN hospitales ON factores.FACTOR_ID=publicaciones.FACTOR_ID AND hospitales.HOS_ID=publicaciones.HOS_ID WHERE publicaciones.USU_ID=$usu_id";
            if ($resultado = $conexion->query($consulta)) {
                while ($fila = $resultado->fetch_assoc()) {
                    $pub_id = $fila['PUB_ID'];
                    $pub_apell = $fila['PUB_APELLIDO'];
                    $pub_nombre = $fila['PUB_NOMBRE'];
                    $pub_cant = $fila['PUB_DADORES_CANT'];
                    $pub_factor = $fila['FACTOR_DESC'];
                    $pub_hosp = $fila['HOS_NOMBRE'];

                    if ($pub_cant > 1) {
                        $dad_label = "dadores";
                    }
                    else {
                        $dad_label = "dador";
                    }
                    //Imprime la publicación con un botón para editarla y otro para finalizarla
                    echo "
                        <div id=\"publicaciones\">
                            <ul id=\"datos_publi\">
                                <li>$pub_apell, $pub_nombre</li>
                                <li>$pub_factor</li>
                                <li>$pub_cant $dad_label</li>
                                <li>$pub_hosp</li>
                            </ul>
                                <div id='btn_donar'>
                                    <button id=\"btn_admin\" onclick=\"location.href='editar_publi.php?pub_id=$pub_id';\"><i class=\"fa fa-pencil\"></i> Editar</button><br>
                                    <button id=\"btn_admin\"><i class=\"fa fa-trash\"></i> Finalizar</button>
                                </div>
                        </div>
                    ";
                }
            }
            else {
                echo "Error al realizar la consulta.";
            }
            $resultado->free();
            $conexion->close();
        ?>
    </section>
</body>
</html>