<?php

/**
 * Se incluye la conexión de la base de datos
 */
include 'conexion.php';

/**
 * Traer id del producto
 *  
 * Se crea la variable $id que almacena el id del producto que se trajo por medio de la variable
 * 'producto' de cualquiera de los siguientes archivos:
 * categoriacomida.php, categoriacerveza.php,categoriarones.php,categoriawhisky.php,categoriashots.php, 
 * categoriavinos.php
 * 
 * @var integer $id            Id del producto tipo entero
*/
$id = $_GET['producto'];

/**
 * Eliminar de la tabla pedido_producto
 * 
 * Se ejecuta la sentencia de eliminar $borrarIntermedia en la tabla pedido_producto
 */
 $borrarIntermedia= mysqli_query($conexion,"DELETE FROM `tbl_pedido_producto`where `id_producto` = '$id'");

 /**
 * Si la variable $borrarIntermedia se realizó correctamente entonces se realiza la otra
 * sentencia
 */ 
 if($borrarIntermedia){

   /**
    * Eliminar de la tabla producto
    * 
    * Se ejecuta la sentencia de eliminar $borrar en la tabla producto
    */
   $borrar = mysqli_query($conexion,"DELETE FROM `tbl_producto` where `id_producto` = '$id'");

   /**
    * Si la variable $borrar se realizó correctamente entonces muestra una alerta  y deja al usuario 
    * administrador en esta vista de 'categorias.php' 
    */
   if ($borrar) {
      echo "<script>alert('Se eliminó correctamente');</script>";
      echo "<script>window.location='../vistas/categorias.php';</script>"; 
   }
   /**
    * De lo contrario muestra una alerta de que no se pudo eliminar
    */
   else{
      echo "<script>alert('No se pudo eliminar correctamente');</script>";
   }
 }
?>