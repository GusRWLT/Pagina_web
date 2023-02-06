<?php
    session_start();
    //Si el usuario está conectado, le asigno su rol a una variable. Si no lo está, lo manda de regreso a la página de inicio
    if (isset($_SESSION['rol']) && isset($_SESSION['id'])) {
        $usu_rol = $_SESSION['rol'];
        $usu_id = $_SESSION['id'];
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
        include("conexion.php");

        //Una consulta SQL para traer los datos del usuario e imprimirlos en los campos de texto
        $consulta = "SELECT usuarios.USU_APELLIDO, usuarios.USU_NOMBRE, usuarios.LOC_ID, usuarios.USU_EMAIL, usuarios.USU_TEL FROM usuarios WHERE usuarios.USU_ID = $usu_id";

        if ($resultado = $conexion->query($consulta)) {
            while ($fila = $resultado->fetch_assoc()) {
                $usu_apell = $fila['USU_APELLIDO'];
                $usu_nombr = $fila['USU_NOMBRE'];
                $usu_loc = $fila['LOC_ID'];
                $usu_mail = $fila['USU_EMAIL'];
                $usu_tel = $fila['USU_TEL'];
            }

        }
        else {
            echo "Se ha producido un error al realizar la consulta." . $consulta . "<br>" . $conexion->error;
            exit();
        }
    ?>

<div class="registro">
        <h1>Editar perfil</h1>
        <form action="codigo/cod_editarusu.php" method="POST">
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
            <label for="apellido">Apellido</label><br>
            <input type="text" name="apellido" class="textbox" maxlength="50" value="<?php echo $usu_apell;?>"><br><br>

            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" class="textbox" maxlength="50" value="<?php echo $usu_nombr; ?>"><br><br>

            <label for="localidad">Localidad</label><br>
            <select name="localidad" class="combobox">
            <?php
                //Lleno el combobox con el listado de localidades
                $consulta = "SELECT * FROM localidades ORDER BY LOC_DESC";
                $resultado = $conexion->query($consulta);
                while ($fila = $resultado->fetch_assoc()) {
                    //Un if para dejar seleccionada la localidad del usuario por defecto
                    if ($fila['LOC_ID'] == $usu_loc) {
                        echo "<option value=" . $fila['LOC_ID'] . " selected>" . $fila['LOC_DESC'] . "</option>";
                    }
                    else {
                        echo "<option value=" . $fila['LOC_ID'] . ">" . $fila['LOC_DESC'] . "</option>";
                    }
                }

            ?>
            </select><br><br>

            <label for="email">Correo electrónico</label><br>
            <input type="email" name="email" class="textbox" maxlength="100" value="<?php echo $usu_mail; ?>"><br><br>

            <label for="tel">Teléfono</label><br>
            <input type="text" name="tel" class="textbox" maxlength="12" value="<?php echo $usu_tel; ?>"><br><br>
            
            <input type="submit" name="editar" class="boton" value="Editar"><br><br>
        </form>
    </div>

</body>
</html>