<?php

/**
 * Se incluye la conexión de la base de datos
 */
include 'conexion.php';

/**
 * Traer id del evento_promoción
 * 
 * Se crea la variable $id que almacena el id del evento_promocion que se trajo por medio de la variable
 * 'evento_promocion' del archivo que está en la carpeta vistas categoriaeventos.php
 * 
 * @var integer $id     Id del evento/promción tipo entero
 */
$id = $_GET['evento_promocion'];

/**
 * Eliminar de la tabla evento_promocion
 * 
 * Se ejecuta la sentencia de eliminar $borrar en la tabla evento_promoción
 */
$borrar = mysqli_query($conexion,"DELETE FROM `tbl_evento_promocion` where `id_evento_promocion` = '$id'");

/**
 * Si la variable $borrar se realizó correctamente entonces muestra una alerta  y deja al usuario 
 * administrador en esta vista de 'categoriaeventos.php' 
 */
if ($borrar) {
    echo "<script>alert('Se eliminó correctamente');</script>";
    echo "<script>window.location='../vistas/categoriaeventos.php';</script>"; 
}
/**
 * De lo contrario
 */
else{
    echo "<script>alert('No se pudo eliminar correctamente');</script>";
}
?>