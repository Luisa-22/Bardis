<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Si se envia el formulario que se encuentra en el archivo categorias.php hará lo sgte.
 */
if(isset($_POST['submit'])){

/**
 * Se crea la variable $nombreProducto que almacena el campo que tiene como nombre 'nombreProducto',
 * el cual se envia del formulario del archivo categorias.php
 * 
 * @var string $nombreProducto		    Nombre del producto, tipo cadena de caracteres
 */
 $nombreProducto = $_POST['nombreProducto'];

/**
 * Se crea la variable $precioProducto que almacena el campo que tiene como nombre 'precioProducto',
 * el cual se envia del formulario del archivo categorias.php
 * 
 * @var float $precioProducto           Precio del producto, tipo decimal
 */
 $precioProducto = $_POST['precioProducto'];

/**
 * Se crea la variable $descripcionProducto que almacena el campo que tiene como nombre 'descripcionProducto',
 * el cual se envia del formulario del archivo categorias.php
 * 
 * @var string $descripcionProducto     Descripcion del producto, tipo cadena de caracteres
 */
 $descripcionProducto = $_POST['descripcionProducto'];

/**
 * Se crea la variable $categoriaProducto que almacena el campo que tiene como nombre 'categoriaProducto',
 * el cual se envia del formulario del archivo categorias.php
 * 
 * @var string $categoriaProducto       Categoria de un producto, tipo cadena de caracteres
 */
 $categoriaProducto = $_POST['categoriaProducto'];

/**
 * Se crea la variable $ced_admin que almacena el campo que tiene como nombre 'ced_admin',
 * el cual se envia del formulario del archivo categorias.php
 * 
 * @var string $ced_admin               Cédula del administrador, tipo cadena de caracteres
 */
 $ced_admin=$_POST['ced_admin'];


/**
* Inserción tabla evento promoción
* 
* Se ejecuta la inserción del formulario de los productos en la tabla producto con sus campos 
* correspondientes insertando cada variable que se creo para almacenar la
* información de cada campo del formulario
*/
$registrarProductos = mysqli_query($conexion, "INSERT INTO `tbl_producto` (`nombre_producto`, 
`precio_producto`,`descripcion_producto`,`id_categoria`,`cedula_administrador`) 
VALUES('$nombreProducto', '$precioProducto', '$descripcionProducto','$categoriaProducto','$ced_admin')") or die (mysqli_error($conexion));

/**
 * Si la variable $registrarProductos se realiza correctamente entonces muestra que se 
 * registró correctamente el producto y deja al usuario en la vista de categorias.php
 */
if($registrarProductos){
    echo "<script>alert('Se registró correctamente');</script>";
    echo "<script>window.location='../vistas/categorias.php';</script>"; 
} 
/**
 * De lo contrario muestra que no se pudo registrar
 */
else {
    echo "<script>alert('No se pudo registrar correctamente');</script>";
}
}

?>
