<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Se incluye el arhivo donde se encuentra el codigo del carrito, para que permita usar 
 * la sesion del carrito
 */
include '../vistas/vercarrito.php';

/**
 * Traer posición
 * 
 * Se crea la variable $i que almacena la posición en la que se encuentra el producto que se quiere eliminar,
 * la cual se trajo del archivo vercarrito.php
 * 
 * @var integer $i        Posición del producto en el arreglo de tipo entero
 */
 $i = $_GET['Pos'];

  /**
  * Si existe la sesion carrito hará lo sgte.
  */
if (isset($_SESSION['carrito'])) {

  /**
   * Se llama a la variable datos que es la que contiene la información de la sesión del carrito
   */
  $datos = $_SESSION['carrito'];

  /**
   * Función unset 
   * 
   * Se utiliza la función unset para que borre la información que hay en una posición especifica del arreglo,
   * entonces se aplica la función unset, se llama la variable que tiene toda la información del carrito
   * que es $datos y se pone la posición que se quiere eliminar $i
   */
  unset($datos[$i]);

  /**
   * Función array_values
   * 
   * Lo que se hace es que se reordena el array, es decir sin dejar posiciones vacías ya que se eliminó
   * información de una posición, finalmente se actualiza la sesión
   */
  $datos=array_values($datos);
  $_SESSION['carrito']=$datos;
  
  /**
   * Si se elimina correctamente muestra una alerta de "Eliminado" y deja al usuario en la vista de 
   * ver carrito, de lo contrario muestra un Error
   */
  echo "<script>alert('Eliminado')</script>";
  echo "<script>window.location='../vistas/vercarrito.php'</script>";
} else {
    echo "<script>alert('Error')</script>";
  }
?>
