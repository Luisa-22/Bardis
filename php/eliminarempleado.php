<?php

/**
 * Se incluye la conexión de la base de datos
 */
include 'conexion.php';

/**
 * Traer cédula del empleado
 * 
 * Se crea la variable $cedula que almacena la cédula del empleado que se trajo por medio de la variable
 * 'empleado' del archivo que está en la carpeta vistas empleados.php
 * 
 * @var string $cedula          Cédula del empleado tipo cadena de caracteres
 */
$cedula = $_GET['empleado'];


/**
 * Consulta a la tabla pedido
 * 
 * Se realiza una consulta a la tabla pedido para traer y almacenar el id de un pedido 
 * donde la cedula del empleado sea igual a la cedula que se trae por la url del archivo
 * empleados.php en la sgte variable:
 * 
 * @var integer $id_p   Id del pedido tipo entero
 */
$pedido= mysqli_query($conexion, "SELECT * FROM tbl_pedido where cedula_empleado='$cedula'");

/**
* En $row se almacena el resultado de la consulta $pedido
*/
$row=mysqli_fetch_array($pedido);

/**
* Se le asigna el resultado de la consulta a la variable $id_p
*/
$id_p=$row['id_pedido'];

/**
 * Eliminar de la tabla pedido
 * 
 * Se ejecuta la sentencia de eliminar $borrarPedido en la tabla pedido, ya que al eliminar
 * un empleado se eliminan los pedidos de ese empleado, por lo tanto hay que eliminar ese 
 * pedido de la tabla intermedia
 */
$borrarPedido= mysqli_query($conexion, "DELETE FROM `tbl_pedido_producto` where `id_pedido` = '$id_p'");

/**
 * Si la variable $borrarPedido se realizó correctamente entonces
 */
if ($borrarPedido) {

   /**
    * Eliminar de la tabla pedido
    *
    * Se ejecuta la sentencia de eliminar $borrarEmpleado en la tabla pedido
    */
   $borrarEmpleadoPedido= mysqli_query($conexion, "DELETE FROM `tbl_pedido` where `cedula_empleado` = '$cedula'");
   
   /**
    * Si la variable $borrarEmpleadoPedido se realizó correctamente entonces
    */
   if ($borrarEmpleadoPedido) {
      
      /**
       * Eliminar de la tabla empleado
       * 
       * Se ejecuta la sentencia de eliminar $borrarEmpleado en la tabla empleado 
       * y se muestra una alerta de que se eliminó correctamente, dejando al usuario administrador en 
       * esta vista de 'empleados.php'
       */
      $borrarEmpleado= mysqli_query($conexion,"DELETE FROM `tbl_empleado` where `cedula_empleado` = '$cedula'");
      echo "<script>alert('Se eliminó correctamente');</script>";
      echo "<script>window.location='../vistas/empleados.php';</script>"; 
   }
   /**
    * De lo contrario muestra una alerta de que no se pudo eliminar y deja al usuario en la vista
    * de empleados.php
    */
   else{
      echo "<script>alert('No se pudo eliminar correctamente');</script>";
      echo "<script>window.location='../vistas/empleados.php';</script>"; 
   }
}

?>