<?php
include '../php/conexion.php';
include '../vistas/vercarrito.php';


$id=$_GET['Id'];

//echo $id;

$datos = $_SESSION['carrito'];

unset($datos[$i][$id]);

$_SESSION['carrito']=$datos;




?>


