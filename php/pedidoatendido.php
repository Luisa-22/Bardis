<?php

include '../php/conexion.php';

    if(isset($_POST['submit'])){
        $id = $_POST['pedido-atendido'];
        mysqli_query($conexion, "UPDATE `tbl_pedido` SET `id_estado` = 'E02' WHERE `tbl_pedido`.`id_pedido` = $id");
    }       
    header("Location: ../vistas/pedidos.php");
?>