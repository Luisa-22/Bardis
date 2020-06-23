<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Si se envia el formulario que se encuentra en el archivo categoriacanciones_usuario.php hará lo sgte.
 */
if(isset($_POST['submit'])){

/**
 * Se crea la variable $nombreCancion que almacena el campo que tiene como nombre 'nombreCancion',
 * el cual se envia del formulario del archivo categoriacanciones_usuario.php
 * 
 * @var string $nombreCancion       Nombre de la canción, tipo cadena de caracteres
 */
 $nombreCancion = $_POST['nombreCancion'];

/**
 * Se crea la variable $nombreInterprete que almacena el campo que tiene como nombre 'nombreInterprete',
 * el cual se envia del formulario del archivo categoriacanciones_usuario.php
 * 
 * @var string $nombreInterprete    Nombre del intérprete, tipo cadena de caracteres
 */
 $nombreInterprete = $_POST['nombreInterprete'];

/**
 * Se crea la variable $ced_c que almacena el campo que tiene como nombre 'ced_cliente',
 * el cual se envia del formulario del archivo categoriacanciones_usuario.php
 * 
 * @var string $ced_c               Cédula del cliente, tipo cadena de caracteres
 */
 $ced_c=$_POST['ced_cliente'];

/**
* Consulta a la base de datos tabla administrador
* 
* Se realiza la consulta '$cap_ced' para traer toda la información del administrador
* y almacenar en la variable $ced_a la cedula del administrador
* 
* @var string $ced_a       Cédula del administrador, tipo cadena de caracteres
*/
$cap_ced=mysqli_query($conexion,"SELECT * FROM tbl_administrador") or die ('error con el dato');

/**
* En $row se almacena el resultado de la consulta $cap_ced
*/
$row=mysqli_fetch_array($cap_ced);

/**
* Se le asigna el resultado de la consulta a la variable $ced_a
*/
$ced_a=$row['cedula_administrador'];


/**
* Inserción tabla canción
* 
* Se ejecuta la inserción del formulario de las canciones en la tabla cancion con sus campos 
* correspondientes insertando cada variable que se creo para almacenar la
* información de cada campo del formulario
*/
$registrarCanciones = mysqli_query($conexion, "INSERT INTO `tbl_cancion` (`nombre_cancion`,
`nombre_interprete`,`cedula_administrador`) 
VALUES('$nombreCancion', '$nombreInterprete','$ced_a')") or die (mysqli_error($conexion));

/**
* Consulta a la base de datos tabla canción
* 
* Se realiza la consulta '$cap_id' para traer toda la información de la última canción
* solicitada y almacenar en la variable $id_c el id de la canción
* 
* @var integer  $id_c      Id de la canción, tipo entero
*/
$cap_id=mysqli_query($conexion,"SELECT * FROM tbl_cancion ORDER by id_cancion DESC LIMIT 1") or die ('error con el dato');

/**
* En $row se almacena el resultado de la consulta $cap_id
*/
$row=mysqli_fetch_array($cap_id);

/**
* Se le asigna el resultado de la consulta a la variable $id_c
*/
$id_c=$row['id_cancion'];

/**
* Inserción en tabla cliente cancion
* 
* Se ejecuta la inserción de los campos de la tabla cliente_cancion, colocando en los valores
* de cada campo las variables que se crearon anteriormente
*/
$query=mysqli_query($conexion,"INSERT INTO tbl_cliente_cancion(documento_cliente,id_cancion)
    VALUES ($ced_c,$id_c)") or die (mysqli_error($conexion));

/**
 * Si la variable $registrarCanciones se realiza correctamente entonces muestra que se 
 * envió correctamente la canción y deja al usuario en la vista de categoriacanciones_usuario.php
 */
if($registrarCanciones){
    echo "<script>alert('Canción enviada correctamente');</script>";
    echo "<script>window.location='../vistas/categoriacanciones_usuario.php';</script>"; 
} 
/**
 * De lo contrario muestra que no se pudo enviar
 */
else {
    echo "<script>alert('No se pudo enviar correctamente');</script>";
}
}
?>