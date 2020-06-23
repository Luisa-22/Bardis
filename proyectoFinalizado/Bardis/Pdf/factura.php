<?php
/** se trae el archivo fdf.php  */
require('fpdf.php');
/** @var $idDelPedido es igual al dato del pedido */
$idDelPedido = $_GET['pedido'];
class PDF extends FPDF
{
 /** se declara la funcion header()  */
function Header()
{
            /**Cell( w,h,string txt,mixed border,int ln,string align,boolean fill, mixed link) */
            //$this->Image('IconoLu17.png',10,6,90);
            // Arial bold 15
            $this->SetFont('Arial','',13);
            /** mover el titulo a la derecha*/
            $this->Cell(100);
            /** Se define el titulo*/
            $this->Cell(50,10,'Alma Bendita Fonda-Bar',0,'','C');
            /** Se define el tipo de letra*/
            $this->SetFont('Arial','',10);
            /**Se hace un salto de linea */
            $this->Ln(15);
            $this->Cell(90);
            $this->Cell(50,10,'NIT: 990456-1');
            /**Se hace un salto de linea */
            $this->Ln(10);
            /* 
            * Se hace un salto de linea 
            */
            $this->Cell(90);
            $this->Cell(50,10,'300 3063080');
            $this->Ln(10);
            $this->Cell(85);
            $this->Cell(50,10,'Cra. 70#46B-58');
            $this->Ln(10);
            $this->SetFont('Arial','B',10);
            $this->Cell(-23);
            $this->Cell(130,60,'Producto',0,'','L');
            $this->Cell(50,60,'Precio  ',0,'','C');
            $this->cell(50,60,'Cantidad',0,'','C');
            $this->Cell(50,60,'Sub total',0,'','C');
            $this->Ln(20);
}
}   
    include '../php/conexion.php';
    /**
        * @var $registro es igual a un msqli_query y le pasamos dos parametro
        * 1 - es la @var $conexion 
        * 2 - Hacemos una consulta a la tabla pedido y trae los campos numero_mesa, id_pedido,total,id_estado donde el estado
        * del pedido sea igual a @var $idDelPedido.
    */
    $registro = mysqli_query($conexion,"SELECT numero_mesa,id_pedido,total,id_estado FROM tbl_pedido WHERE id_pedido = $idDelPedido") or die ('error con el dato');
    /**
        * Abrimos un ciclo while para que me recorra la tabla y me traiga los datos de la tabla pedido que esta
        * guardada en la @var $registro.
   */
    while($rowproducto = $registro->fetch_assoc()){
    $pdf = new PDF('P','pt',array(350,300));
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $idPedido = $rowproducto['id_pedido'];
    /**
        * @var $sql es igual a un msqli_query y le pasamos dos parametro
        * 1 - es la @var $conexion 
        * 2 - Hacemos una consulta a la tabla pedido_producto y trae los campos id_producto,cantidad donde el id_pedido
        * del pedido sea igual a @var v.
    */
    $sql = mysqli_query($conexion,"SELECT id_producto,cantidad FROM tbl_pedido_producto WHERE id_pedido = $idDelPedido");
    /**
        * Abrimos un ciclo while para que me recorra la tabla y traiga los datos de la tabla pedido_producto que esta
        * guardada en la @var $producto.
    */
    while($producto = mysqli_fetch_array($sql)){
    
    $idP = $producto['id_producto'];
    /**
        * @var $selectP es igual a un msqli_query y le pasamos dos parametro
        * 1 - es la @var $conexion 
        * 2 - Hacemos una consulta a la tabla producto y trae los campos nombre_producto,precio_producto donde el id
        * del producto sea igual a @var $idP.
    */
    $selectP = mysqli_query($conexion,("SELECT nombre_producto,precio_producto FROM tbl_producto WHERE id_producto = $idP"));
     /**
        * Abrimos un ciclo while para que me recorra la tabla y traiga los datos de la tabla producto que esta
        * guardada en la @var $selectP.
    */
    while($rowPro = mysqli_fetch_array($selectP)){
    $pdf->Cell(-23);
    $pdf->Cell(130,60,$rowPro['nombre_producto'],0,'','L');
    $pdf->Cell(50,60,$rowPro['precio_producto'],0,'','C');
    $pdf->Cell(50,60,$producto['cantidad'],0,'','C');
    $subtotal = $rowPro['precio_producto'] * $producto['cantidad'];
    $pdf->Cell(50,60,"$".$subtotal,0,'','C');
    $pdf->Ln(20);
    /**Cerramos el ciclo de la consulta de la tabla producto */
    }
    /** Cerramos el ciclo de la consulta de la tabla pedido_producto*/
    }
    $pdf->SetFont('Arial','B',10);
    
    $pdf->Ln(50);
    $pdf->cell(-23);
    $pdf->cell(230,50,'Total',0,0,'L',0);
    $pdf->SetFont('Arial','',10);
    $pdf->cell(50,50,"$".$rowproducto['total'],0,0,'C','');
 /**cerramos el ciclo de la consulta de pedido */}
    $pdf->Output();
?>