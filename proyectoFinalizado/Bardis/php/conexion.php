<?php
/**
 * Conexión
 * 
 * Se almacena la conexion en la variable $conexion, luego se utiliza la función 
 * mysqli_connect que permite abrir una nueva conexión al servidor MySQL, luego
 * se coloca el servidor, el usuario, la contraseña y el nombre de la base de datos.
 * 
 * Si la conexión no se realiza correctamente muestra que hay un error en la conexión.
 * 
 */
$conexion = mysqli_connect("localhost", "root", "", "bardis") or die('Error en la conexión '. mysqli_error($conexion));
?>