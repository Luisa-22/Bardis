<?php
include '../php/conexion.php';

if(isset($_POST['submit'])){

$nombreCancion = $_POST	['nombreCancion'];
$nombreInterprete = $_POST['nombreInterprete'];

$ced_c=$_POST['ced_cliente'];

$cap_ced=mysqli_query($conexion,"SELECT * FROM tbl_administrador ORDER by cedula_administrador DESC LIMIT 1") or die ('error con el dato');
$row=mysqli_fetch_array($cap_ced);
$ced_a=$row['cedula_administrador'];

$registrarCanciones = mysqli_query($conexion, "INSERT INTO `tbl_cancion` (`nombre_cancion`,
`nombre_interprete`,`cedula_administrador`) 
VALUES('$nombreCancion', '$nombreInterprete','$ced_a')") or die (mysqli_error($conexion));

$cap_id=mysqli_query($conexion,"SELECT * FROM tbl_cancion ORDER by id_cancion DESC LIMIT 1") or die ('error con el dato');
$row=mysqli_fetch_array($cap_id);
$id_c=$row['id_cancion'];


$query=mysqli_query($conexion,"INSERT INTO tbl_cliente_cancion(documento_cliente,id_cancion)
    VALUES ($ced_c,$id_c)") or die (mysqli_error($conexion));


if($registrarCanciones){
    echo "<script>alert('Canción enviada correctamente');</script>";
    echo "<script>window.location='../vistas/categoriacanciones_usuario.php';</script>";
    
} else {
    echo "<script>alert('No se pudo enviar correctamente');</script>";
}
}

?>