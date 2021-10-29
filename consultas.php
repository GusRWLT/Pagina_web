<?php
    //Estas funciones sirven para llenar los combobox de localidades y factores en el formulario de registro
    function combo_loc() {  //Creo una función con el nombre "combo_loc"
        include("conexion.php");    //Incluyo el archivo de la conexión con la BD a este archivo, así no tengo que volverlo a escribir todo de nuevo

        $consulta = "SELECT * FROM localidades ORDER BY LOC_DESC";
        $resultado = $conexion->query($consulta);  //Crea una variable de nombre "resultado" y le asigna el resultado de la consulta SQL SELECT
        while ($fila = $resultado->fetch_assoc()) {    //Inicia un bucle while recorriendo cada registro de la consulta, almacenándolas en la variable "fila"
            echo "<option value=" . $fila['LOC_ID'] . ">" . $fila['LOC_DESC'] . "</option>";  //Imprime un código HTML creando las opciones del combobox con los datos obtenidos de la BD (los puntos sirven para concatenar strings y datos)
        }
        $resultado->free();   //Libero el espacio en memoria ocupado por la variable "resultado"
        $conexion->close();    //Cierro la conexión con la DB
    }

    function combo_factor() {
        include("conexion.php");

        //Lo mismo que el código de arriba, pero esta vez para los factores
        $consulta = "SELECT * FROM factores";
        $resultado = $conexion->query($consulta);
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value=" . $fila['FACTOR_ID'] . ">" . $fila['FACTOR_DESC'] . "</option>";
        }
        $resultado->free();
        $conexion->close();
    }

    //Carga de datos de hospitales en un ComboBox
    function combo_hospital() {
        include("conexion.php");

        $consulta = "SELECT HOS_ID, HOS_NOMBRE FROM hospitales";
        $resultado = $conexion->query($consulta);
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value=" . $fila['HOS_ID'] . ">" . $fila['HOS_NOMBRE'] . "</option>";
        }
        $resultado->free();
        $conexion->close();
    }
?>