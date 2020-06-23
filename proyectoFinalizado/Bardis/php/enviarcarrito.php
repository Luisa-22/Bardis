<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Se incluye el arhivo donde se encuentra el codigo del carrito, para que permita usar 
 * la sesion del carrito
 */
include '../vistas/vercarrito.php';

/**
 * Si se envia el formulario que se encuentra en el archivo vercarrito.php hará lo sgte.
 */
if(isset($_POST['enviar'])){

    /**
     * Se crea la variable $total_pe que almacena el campo que tiene como nombre 'total_p',
     * el cual se envia del formulario del archivo vercarrito.php
     * 
     * @var float $total_pe     Total a pagar de un pedido, tipo decimal
     */
     $total_pe=$_POST['total_p'];

     /**
     * Se crea la variable $mesa_p que almacena el campo que tiene como nombre 'mesa',
     * el cual se envia del formulario del archivo vercarrito.php
     * 
     * @var int $mesa_p         Número de mesa de un pedido, tipo entero
     */
     $mesa_p=$_POST['mesa'];
     
     /**
     * Se crea la variable $ced_m que almacena el campo que tiene como nombre 'ced_mesero',
     * el cual se envia del formulario del archivo vercarrito.php 
     * 
     * @var string $ced_m       Cédula del mesero que hace el pedido, tipo cadena de caracteres
     */
     $ced_m=$_POST['ced_mesero'];

    /**
     * Verificar si el pedido está vacío
     * 
     * Se realiza una condición de que si la variable que almacena toda la información del
     * pedido ($datos) está vacía, lo que hace es que muestra una alerta que indica que no hay productos 
     * en el pedido lo que no permite enviar el pedido y deja al usuario en la vista del pedido vercarrito.php
     */
    if (empty($datos)) {
        echo "<script>alert('No hay productos en el pedido, por lo tanto no se puede enviar');</script>";
        echo "<script>window.location='../vistas/vercarrito.php';</script>";
    }
    /**
     * De lo contrario, va a realizar las inserciones de la información en la base de datos
     */
    else{

    /**
     * Inserción en tabla pedido
     * 
     * Se ejecuta la inserción del pedido en la tabla pedido con sus campos 
     * correspondientes insertando cada variable que se creo para almacenar la
     * información que se trajo del archivo vercarrito.php, si no se insertan los campos
     * correctamente se muestra una alerta de que ocurrió un error
     */
    $query=mysqli_query($conexion,"INSERT INTO tbl_pedido(total,numero_mesa,id_estado,cedula_empleado) VALUES ($total_pe,$mesa_p,'E01',$ced_m)") or die ("<script>alert('Ocurrió un error, intente de nuevo');</script>");

    /**
     * Consulta para capturar id pedido
     * 
     * Se realiza una consulta a la tabla pedido para traer y almacenar el id de un pedido en la sgte variable:
     * 
     * @var integer $id_p   Id del pedido tipo entero
     */
    $registro=mysqli_query($conexion,"SELECT id_pedido FROM tbl_pedido ORDER by id_pedido DESC LIMIT 1") or die (mysqli_error($conexion));
    
    /**
     * En $row se almacena el resultado de la consulta $registro
     */
    $row=mysqli_fetch_array($registro);

    /**
     * Se le asigna el resultado de la consulta a la variable $id_p
     */
    $id_p=$row['id_pedido'];

    /**
     * Creación ciclo for
     * 
     * Ciclo for, donde i comienza en 0 hasta que i sea menor al numero de posiciones del arreglo
     */
    for($i = 0; $i < count($datos); $i++){

    /**
     * Se crean dos variables que son $cantidad y $cod_pro que almacenan el id y la cantidad de un 
     * producto 
     *  
     * @var integer $cantidad       Cantidad del producto tipo entero
     * @var integer $cod_pro        Id del producto tipo entero 
     */    
    $cantidad=$datos[$i]['Cantidad'];
    $cod_pro=$datos[$i]['Id'];

    /**
     * Inserción en tabla pedido producto
     * 
     * Se ejecuta la inserción de los campos de la tabla pedido_producto, colocando en los valores
     * de cada campo las variables que se crearon anteriormente
     */
    $query=mysqli_query($conexion,"INSERT INTO tbl_pedido_producto(id_pedido,id_producto,cantidad)
    VALUES ($id_p,$cod_pro,$cantidad)");
    }

    /**
     * Alerta pedido
     * 
     * Se muestra una alerta de que el pedido fue exitoso
     * Luego se utiliza la función unset, para que cuando se envíe un pedido se limpie el carrito
     */
    echo "<script>alert('Pedido exitoso');</script>";
    echo "<script>window.location='../vistas/categoriasnuevas.php';</script>";
    unset($_SESSION['carrito']);
    }
}
?>