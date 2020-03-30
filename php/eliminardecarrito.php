<?php
include '../php/conexion.php';
include '../vistas/vercarrito.php';


$id = $_GET['Id'];
    
if (isset($_SESSION['carrito'])) {
    $datos = $_SESSION['carrito'];
    
        unset($datos[$id]);
        $datos = array_values($datos);
        $_SESSION['carrito']=$datos;
        echo "<script>alert('Eliminado')</script>";
        echo "<script>window.location='../vistas/vercarrito.php'</script>";
    }

    echo "error";
?>
