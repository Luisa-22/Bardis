<?php
include 'conexion.php';

$numeroMesa = $_GET['mesa'];

$borrar = mysqli_query($conexion,"DELETE FROM `tbl_mesa` where `numero_mesa` = '$numeroMesa'");
header('location: ../vistas/mesas.php');


?>