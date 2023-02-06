<?php
    session_start();
    //Si el usuario está conectado, le asigno su rol a una variable. Si no lo está, lo manda de regreso a la página de inicio
    if (isset($_SESSION['rol'])) {
        $usu_rol = $_SESSION['rol'];
    }
    else {
        header("location:index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar es ayudar - Editar publicación</title>
    <link rel="stylesheet" href="estilos/registro.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--Acá quise simplificar un poco la cabecera.-->
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

    <?php
        //Tomo el id guardado en la URL, si no existe, regresa a la página de inicio
        if (isset($_GET['pub_id'])) {
            $pub_id = $_GET['pub_id'];
        }
        else {
            header("location:index.php");
            exit();
        }

        include("conexion.php");

        //Una consulta SQL para traer los datos de la publicación e imprimirlos en los campos de texto
        $consulta = "SELECT PUB_APELLIDO, PUB_NOMBRE, PUB_DADORES_CANT, PUB_FECHA_LIM FROM publicaciones WHERE PUB_ID=$pub_id";
        if ($resultado = $conexion->query($consulta)) {
            while ($fila = $resultado->fetch_assoc()) {
                $pub_apell = $fila['PUB_APELLIDO'];
                $pub_nombr = $fila['PUB_NOMBRE'];
                $pub_cant = $fila['PUB_DADORES_CANT'];
                $pub_fecha = $fila['PUB_FECHA_LIM'];
            }
        }
        else {
            echo "Se ha producido un error al realizar la consulta.";
        }

        //Guardo en una variable la fecha actual
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha_min = date("Y-m-d");
    ?>

    <div class="registro">
        <h1>Editar publicación</h1>
        <form action="codigo/cod_editarpub.php" method="POST">
            <?php
                //Imprimo un mensaje de error
                if (isset($_SESSION['error'])) {
                    echo "
                        <div class=\"alerta\">
                            <p>".$_SESSION['error']."</p>
                        </div>";
                    unset($_SESSION['error']);    //Una función para vaciar la variable
                }
            ?>

            <!--Lleno los campos con los datos actuales para luego ser editados-->
            <label for="apellido">Apellido del paciente<label><br>
            <input type="text" name="apellido" class="textbox" maxlength="50" value="<?php echo $pub_apell;?>"><br><br>

            <label for="nombre">Nombre del paciente<label><br>
            <input type="text" name="nombre" class="textbox" maxlength="50" value="<?php echo $pub_nombr; ?>"><br><br>

            <label for="dadores">Dadores requeridos</label><br>
            <input type="number" name="dadores" class="textbox" min="1" max="15" value="<?php echo $pub_cant; ?>"><br><br>

            <label for="fecha_lim">Fecha límite</label><br>
            <input type="date" name="fecha_lim" class="datebox" min="<?php echo $fecha_min?>" value="<?php echo $pub_fecha; ?>"><br><br>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id; ?>">
            
            <input type="submit" name="editar" class="boton" value="Editar"><br><br>
        </form>
    </div>
</body>
</html>
