<?php
    session_start();
    //Me aseguro que sólo aquellos con rol admin o médicx puedan acceder, sino los manda al inicio
    if (isset($_SESSION['rol'])) {
        $usu_rol = $_SESSION['rol'];
        if ($usu_rol == 2) {
            header("location:index.php");
            exit();
        }
    }
    else {
        header("location:index.php");
        exit();
    }
?>

<!--Inicia HTML5-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Panel Donaciones</title>
    <link rel="stylesheet" href="estilos/principal.css">
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
        <!--Imprime en pantalla el listado de las peticiones para donar, con los datos del dador por un lado, y del paciente del otro-->
        <?php
            include("conexion.php");

            $consulta = "SELECT dadores.PUB_ID, dadores.USU_ID, usuarios.USU_APELLIDO, usuarios.USU_NOMBRE, usuarios.USU_DNI, usuarios.FACTOR_ID AS USU_FACTOR, publicaciones.PUB_APELLIDO, publicaciones.PUB_NOMBRE, publicaciones.PUB_DNI, publicaciones.FACTOR_ID AS PUB_FACTOR FROM dadores INNER JOIN usuarios ON dadores.USU_ID=usuarios.USU_ID INNER JOIN publicaciones ON dadores.PUB_ID=publicaciones.PUB_ID WHERE dadores.DAS_ID=1";
            if ($resultado = $conexion->query($consulta)) {
                while ($fila = $resultado->fetch_assoc()) {
                    $pub_id = $fila['PUB_ID'];
                    $usu_id = $fila['USU_ID'];
                    $fac_dador = $fila['USU_FACTOR'];
                    $fac_pacie = $fila['PUB_FACTOR'];
                    $pub_apell = $fila['PUB_APELLIDO'];
                    $pub_nombre = $fila['PUB_NOMBRE'];
                    $usu_apell = $fila['USU_APELLIDO'];
                    $usu_nombre = $fila['USU_NOMBRE'];
                    $pub_dni = $fila['PUB_DNI'];
                    $usu_dni = $fila['USU_DNI'];
                    
                    echo "
                        <div class=\"cont_dadores\">
                            <div class=\"dadores\">
                                <table>
                                    <tr>
                                        <th>Dador:</th>
                                        <th>Paciente:</th>
                                    </tr>
                                    <tr>
                                        <td><li>$usu_apell, $usu_nombre</li></td>
                                        <td><li>$pub_apell, $pub_nombre</li></td>
                                    </tr>
                                    <tr>
                                        <td><li>$usu_dni</li></td>
                                        <td><li>$pub_dni</li></td>
                                    </tr>
                                </table>
                                <div class=\"btn_dadores\">
                                    <button class=\"btn_dador\" onclick=\"location.href='codigo/cod_aprobar.php?usu_id=$usu_id&pub_id=$pub_id';\"><i class=\"fa fa-check\"></i> Aceptar</button>
                                    <button class=\"btn_dador\" onclick=\"location.href='codigo/cod_rechazar.php?usu_id=$usu_id&pub_id=$pub_id';\"><i class=\"fa fa-close\"></i> Rechazar</button>
                                </div>
                            </div>
                        </div>
                    ";
                    
                }
            }
            else {
                echo "Error al cargar de los datos de la base de datos.";
            }
            $resultado->free();
            $conexion->close();
        ?>

</body>
</html>
