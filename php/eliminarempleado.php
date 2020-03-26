<?php
include 'conexion.php';

$cedula = $_GET['empleado'];

$borrar = mysqli_query($conexion,"DELETE FROM `tbl_empleado` where `cedula_empleado` = '$cedula'");
header('location: ../vistas/empleados.php');


?>