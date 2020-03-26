<?php
include 'conexion.php';

$id = $_GET['evento_promocion'];

$borrar = mysqli_query($conexion,"DELETE FROM `tbl_evento_promocion` where `id_evento_promocion` = '$id'");
header('location: ../vistas/categoriaeventos.php');


?>