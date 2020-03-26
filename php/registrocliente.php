<?php
include '../php/conexion.php';

if(isset($_POST['submitCliente'])){

$documentoCliente = $_POST	['documentoCliente'];
$nombreCliente = $_POST['nombreCliente'];
$correoCliente = $_POST['correoCliente'];
$edadCliente = $_POST['edadCliente'];
$password = $_POST['password'];
$confirmarPassword = $_POST['confirmarPassword'];

$verificarDocumento = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `documento_cliente` = '$documentoCliente'");
$verificarCorreo = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `correo_cliente` = '$correoCliente'");

$verificacion1 = mysqli_num_rows($verificarDocumento);
$verificacion2 = mysqli_num_rows($verificarCorreo);

if ($verificacion1==1){
	echo "<script type='text/javascript'>alert('El documento ya existe');</script>";
	echo "<script>window.location='../vistas/registro.php';</script>";
	
}elseif ($verificacion2==1){
	echo "<script type='text/javascript'>alert('El correo ya existe');</script>";
	echo "<script>window.location='../vistas/registro.php';</script>";
}
else{

$registrarClientes = mysqli_query($conexion, "INSERT INTO `tbl_cliente` (`documento_cliente`,`nombre_cliente`, `correo_cliente`, `edad_cliente`,
 `clave_cliente`) VALUES('$documentoCliente', '$nombreCliente', '$correoCliente', '$edadCliente', '$password')");

if($registrarClientes) {
	echo "<script>alert('Se registró correctamente');</script>";
    echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
} else {
	echo "<script>alert('No se pudo registrar correctamente,intente de nuevo');</script>";
    echo "<script>window.location='../vistas/registro.php';</script>";
}

}

}

?>
