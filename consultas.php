<?php
    //Estas funciones sirven para llenar los combobox de localidades y factores en el formulario de registro
    function combo_loc() {  //Creo una función con el nombre "combo_loc"
        include("conexion.php");    //Incluyo el archivo de la conexión con la BD a este archivo, así no tengo que volverlo a escribir todo de nuevo

        $query = "SELECT * FROM localidades ORDER BY LOC_DESC";
        $sql = mysqli_query($conexion, $query);  //Crea una variable de nombre "sql" y le asigna el resultado de la consulta SQL SELECT
        while ($row = $sql->fetch_assoc()) {    //Inicia un bucle while recorriendo cada registro de la consulta, almacenándolas en la variable "row" (fila)
            echo "<option value=" . $row['LOC_ID'] . ">" . $row['LOC_DESC'] . "</option>";  //Imprime un código HTML creando las opciones del combobox con los datos obtenidos de la BD (los puntos sirven para concatenar strings y datos)
        }
        mysqli_free_result($sql);   //Libero el espacio en memoria ocupado por la variable "sql"
        mysqli_close($conexion);    //Cierro la conexión con la DB
    }

    function combo_factor() {
        include("conexion.php");

        //Lo mismo que el código de arriba, pero esta vez para los factores
        $query = "SELECT * FROM factores";
        $sql = mysqli_query($conexion, $query);
        while ($row = $sql->fetch_assoc()) {
            echo "<option value=" . $row['FACTOR_ID'] . ">" . $row['FACTOR_DESC'] . "</option>";
        }
        mysqli_free_result($sql);
        mysqli_close($conexion);
    }

    function combo_hospital() {
        include("conexion.php");

        $query = "SELECT HOS_ID, HOS_NOMBRE FROM hospitales";
        $sql = mysqli_query($conexion, $query);
        while ($row = $sql->fetch_assoc()) {
            echo "<option value=" . $row['HOS_ID'] . ">" . $row['HOS_NOMBRE'] . "</option>";
        }
        mysqli_free_result($sql);
        mysqli_close($conexion);
    }
?>