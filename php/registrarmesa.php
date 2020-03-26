<?php
include '../php/conexion.php';

if(isset($_POST['submit'])){

$numeroMesa = $_POST['numeroMesa'];
$ubicacionMesa = $_POST['ubicacionMesa'];


$registrarMesas = mysqli_query($conexion, "INSERT INTO `tbl_mesa` (`numero_mesa`,
`ubicacion_mesa`) 
VALUES('$numeroMesa', '$ubicacionMesa')") or die (mysqli_error($conexion));
  

if(!$registrarMesas){
    echo '<script language="javascript"> alert("No registrado con éxito");</script>';
} else {
    echo '<script language="javascript"> alert("Registrado con éxito");</script> ';
}
header ('location: ../vistas/mesas.php');
echo '<script language="javascript"> alert("Registrado con éxito");</script> ';

}

?>
