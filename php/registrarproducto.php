<?php
include '../php/conexion.php';

if(isset($_POST['submit'])){


$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$descripcionProducto = $_POST['descripcionProducto'];
$categoriaProducto = $_POST['categoriaProducto'];
$ced_admin=$_POST['ced_admin'];


$registrarProductos = mysqli_query($conexion, "INSERT INTO `tbl_producto` (`nombre_producto`, 
`precio_producto`,`descripcion_producto`,`id_categoria`,`cedula_administrador`) 
VALUES('$nombreProducto', '$precioProducto', '$descripcionProducto','$categoriaProducto','$ced_admin')") or die (mysqli_error($conexion));

if(!$registrarProductos){
    echo '<script language="javascript"> alert("No registrado con éxito");</script>';
} else {
    echo '<script language="javascript"> alert("Registrado con éxito");</script> ';
}
header ('location: ../vistas/categorias.php');
echo '<script language="javascript"> alert("Registrado con éxito");</script> ';

}

?>
