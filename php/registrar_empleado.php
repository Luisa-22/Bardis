<?php
include '../php/conexion.php';

if(isset($_POST['submit'])){

$cedula = $_POST['cedula'];
$nombreEmpleado = $_POST['nombreEmpleado'];
$apellidoEmpleado = $_POST['apellidoEmpleado'];
$celular1Empleado = $_POST['celularEmpleado'];
$correoEmpleado = $_POST['correoEmpleado'];
$password = $_POST['password'];
$confirmarPassword = $_POST['confirmarPassword'];
$rol = $_POST['rol'];


if ($password == $confirmarPassword) {

$registrarEmpleados = mysqli_query($conexion, "INSERT INTO `tbl_empleado` (`cedula_empleado`,`nombre_empleado`, 
`apellido_empleado`,`celular1_empleado`,`correo_empleado`,`clave_empleado`,id_tipo_empleado) 
VALUES('$cedula', '$nombreEmpleado', '$apellidoEmpleado', '$celular1Empleado','$correoEmpleado' ,
'$password','$rol')") or die (mysqli_error($conexion));
}
 if($registrarEmpleados) {
    echo "<script>alert('Empleado registrado correctamente');</script>";
    echo "<script>window.location='../vistas/empleados.php';</script>";
    
} else {
    echo "<script>alert('No se pudo registrar');</script>";
    
}
}

?>
