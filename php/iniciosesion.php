<?php
include '../php/conexion.php';

$documento=$_POST['documento'];
$password=$_POST['password'];
$rol = $_POST['rol'];
 

if($rol == 'user') {
   $cliente = mysqli_query ($conexion, "SELECT *  FROM tbl_cliente where documento_cliente = '$documento' and clave_cliente = '$password'");
if(mysqli_num_rows ($cliente) == 1) {
    session_start() ;
$row =mysqli_fetch_array($cliente) ;
$_SESSION ['cliente' ]  = $row['documento_cliente'] ;
header("Location: ../vistas/perfilusuario.php");

}else{
    echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
    echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
    
}
}

if($rol== 'admin') {
    $administrador = mysqli_query ($conexion, "SELECT * FROM tbl_administrador where cedula_administrador = '$documento' and clave_administrador = '$password'");
  if(mysqli_num_rows ($administrador) == 1) {
    session_start() ;
  $row =mysqli_fetch_array($administrador) ;
  $_SESSION ['administrador' ]  = $row['cedula_administrador'] ;

  header("Location: ../vistas/perfiladministrador.php");

}else{
    echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
    echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
}
}

if($rol=='001') {
    $mesero = mysqli_query ($conexion, "SELECT * FROM tbl_empleado where cedula_empleado = '$documento' and clave_empleado= '$password' and id_tipo_empleado = '001'");
  if(mysqli_num_rows ($mesero) == 1) {
  session_start() ;
  $row =mysqli_fetch_array($mesero) ;
  $_SESSION ['mesero' ]  = $row['cedula_empleado'] ;

  header("Location: ../vistas/perfilmesero.php");

}else{
    echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
    echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
}
}

if($rol=='002') {
    $dj = mysqli_query ($conexion, "SELECT * FROM tbl_empleado where cedula_empleado = '$documento' and clave_empleado = '$password' and id_tipo_empleado = '002'");
   if(mysqli_num_rows ($dj) == 1) {
    session_start() ;
   $row =mysqli_fetch_array($dj) ;
   $_SESSION ['dj' ]  = $row['cedula_empleado'] ;

   header("Location: ../vistas/perfildj.php");
   
}else{
    echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
    echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
}
}


?>