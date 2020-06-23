<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Si se envia el formulario que se encuentra en la carpeta vistas, el archivo pedidos.php hará lo sgte.
 */
if(isset($_POST['submit'])){

    /**
     * Se recibe el id del pedido en la variable $id el cual viene por medio de la 
     * variable pedido-atendido del archivo pedidos.php
     * 
     * @var integer $id         Id del pedido de tipo entero
     */
    $id = $_POST['pedido-atendido'];
    
    /**
     * Actualizar estado de un pedido en la base de datos
     * 
     * Se ejecuta la sentencia update en la tabla pedido para actualizar el estado de un
     * pedido y por ultimo se deja al usuario administrador en el misma vista de los pedidos
     */
    $pedido= mysqli_query($conexion, "UPDATE `tbl_pedido` SET `id_estado` = 'E02' WHERE `tbl_pedido`.`id_pedido` = $id");
    header("Location: ../vistas/pedidos.php");
}       
?>