<?php
include 'conexion.php';

$id = $_GET['producto'];

$borrar = mysqli_query($conexion,"DELETE FROM `tbl_producto` where `id_producto` = '$id'");
header('location: ../vistas/categorias.php');


?>