<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Si se envia el formulario que se encuentra en el archivo registro.php hará lo sgte.
 */
if(isset($_POST['submitCliente'])){

/**
 * Se crea la variable $documentoCliente que almacena el campo que tiene como nombre 'documentoCliente',
 * el cual se envia del formulario del archivo registro.php
 * 
 * @var string $documentoCliente		Documento del cliente, tipo cadena de caracteres
 */
 $documentoCliente = $_POST['documentoCliente'];

 /**
 * Se crea la variable $nombreCliente que almacena el campo que tiene como nombre 'nombreCliente',
 * el cual se envia del formulario del archivo registro.php
 * @var string $nombreCliente			Nombre del cliente, tipo cadena de caracteres
 */ 
 $nombreCliente = $_POST['nombreCliente'];

 /**
 * Se crea la variable $correoCliente que almacena el campo que tiene como nombre 'correoCliente',
 * el cual se envia del formulario del archivo registro.php
 * 
 * @var string $correoCliente			Correo del cliente, tipo cadena de caracteres
 */
 $correoCliente = $_POST['correoCliente'];

 /**
 * Se crea la variable $edadCliente que almacena el campo que tiene como nombre 'edadCliente',
 * el cual se envia del formulario del archivo registro.php
 * 
 * @var integer $edadCliente			Edad del cliente, tipo entero
 */
 $edadCliente = $_POST['edadCliente'];

 /**
 * Se crea la variable $password que almacena el campo que tiene como nombre 'password',
 * el cual se envia del formulario del archivo registro.php
 * 
 * @var string $password				Clave del cliente, tipo cadena de caracteres
 */
 $password = $_POST['password'];

 /**
 * Se crea la variable $confirmarPassword que almacena el campo que tiene como nombre 'confirmarPassword',
 * el cual se envia del formulario del archivo registro.php
 * 
 * @var string $confirmarPassword		Confirmar clave del cliente, tipo cadena de caracteres 
 */
 $confirmarPassword = $_POST['confirmarPassword'];

/**
 * Consultas a la base de datos tabla cliente
 * 
 * Se realizan dos consultas a la tabla cliente para verificar que ni el documento y el correo 
 * enviado por el formulario, existan en la base de datos
 */
$verificarDocumento = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `documento_cliente` = '$documentoCliente'");
$verificarCorreo = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `correo_cliente` = '$correoCliente'");

/**
 * Se cuentan los resultados encontrados en cada consulta
 */
$verificacion1 = mysqli_num_rows($verificarDocumento);
$verificacion2 = mysqli_num_rows($verificarCorreo);

/**
 * Si las consultas encuentran resultados se muestran las alertas correspondientes
 */
if ($verificacion1==1){
	echo "<script type='text/javascript'>alert('El documento ya existe');</script>";
	echo "<script>window.location='../vistas/registro.php';</script>";
	
}elseif ($verificacion2==1){
	echo "<script type='text/javascript'>alert('El correo ya existe');</script>";
	echo "<script>window.location='../vistas/registro.php';</script>";
}

/**
 * De lo contrario
 */
else{

/**
* Inserción tabla evento cliente
* 
* Se ejecuta la inserción del formulario del cliente en la tabla cliente con sus campos 
* correspondientes insertando cada variable que se creo para almacenar la
* información de cada campo del formulario
*/
$registrarClientes = mysqli_query($conexion, "INSERT INTO `tbl_cliente` (`documento_cliente`,`nombre_cliente`, `correo_cliente`, `edad_cliente`,
 `clave_cliente`) VALUES('$documentoCliente', '$nombreCliente', '$correoCliente', '$edadCliente', '$password')");

/**
 * Si la variable $registrarClientes se realiza correctamente entonces muestra que se 
 * registró correctamente el producto y deja al usuario en la vista de iniciar_sesion.php
 */
if($registrarClientes) {
	echo "<script>alert('Se registró correctamente');</script>";
    echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
} 
/**
 * De lo contrario muestra que no se pudo registrar y deja al usuario en la vista del registro
 */
else {
	echo "<script>alert('No se pudo registrar correctamente,intente de nuevo');</script>";
    echo "<script>window.location='../vistas/registro.php';</script>";
}
}
}
?>
