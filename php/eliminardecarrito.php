<?php
include '../php/conexion.php';
include '../vistas/vercarrito.php';


$i = $_GET['Pos'];

if (isset($_SESSION['carrito'])) {
    $datos = $_SESSION['carrito'];
    unset($datos[$i]);
    $datos=array_values($datos);
    $_SESSION['carrito']=$datos;

    echo "<script>alert('Eliminado')</script>";
    echo "<script>window.location='../vistas/vercarrito.php'</script>";
}else {
    echo "<script>alert('Error')</script>";
    }
?>
