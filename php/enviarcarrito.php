<?php

include '../php/conexion.php';
include '../vistas/vercarrito.php';

if(isset($_POST['enviar'])){

    $datos = $_SESSION['carrito'];
    $total_pe=$_POST['total_p'];
    $mesa_p=$_POST['mesa'];
    $ced_m=$_POST['ced_mesero'];
    
    $query=mysqli_query($conexion,"INSERT INTO tbl_pedido(total,numero_mesa,id_estado,cedula_empleado) VALUES ($total_pe,$mesa_p,'E01',$ced_m)") or die ('error al insertar');

    $registro=mysqli_query($conexion,"SELECT * FROM tbl_pedido ORDER by id_pedido DESC LIMIT 1") or die ('error con el dato');
    $row=mysqli_fetch_array($registro);
    $id_p=$row['id_pedido'];


    for($i = 0; $i < count($datos); $i++){
    
    $cantidad=$datos[$i]['Cantidad'];
    $cod_pro=$datos[$i]['Id'];

    $query=mysqli_query($conexion,"INSERT INTO tbl_pedido_producto(id_pedido,id_producto,cantidad)
    VALUES ($id_p,$cod_pro,$cantidad)") or die (mysqli_error($conexion));

    }

    echo "<script>alert('Pedido exitoso');</script>";
    echo "<script>window.location='../vistas/categoriasnuevas.php';</script>";
    unset($_SESSION['carrito']);
    
}

?>