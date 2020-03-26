<?php
require('fpdf.php');
$idDelPedido = $_GET['pedido'];
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
     // Logo
            //$this->Image('IconoLu17.png',10,6,90);
            // Arial bold 15
            $this->SetFont('Arial','',13);
            // Move to the right
            $this->Cell(70);
            // Title
            $this->Cell(50,10,'Alma Bendita Fonda-Bar',0,'','C');
            $this->SetFont('Arial','',10);
            $this->Ln(15);
            $this->Cell(60);
            $this->Cell(50,10,'NIT: 990456-1');
            $this->Ln(10);
            $this->Cell(64);
            $this->Cell(50,10,'300 3063080');
            $this->Ln(10);
            $this->Cell(55);
            $this->Cell(50,10,'Cra. 70#46B-58');
            // Line break
            $this->Ln(10);
            $this->SetFont('Arial','B',10);
            $this->Cell(-23);
            $this->Cell(88,60,'Producto',0,'','L');
            $this->Cell(50,60,'Precio  ',0,'','C');
            $this->cell(50,60,'Cantidad',0,'','C');
            $this->Cell(50,60,'Sub total',0,'','C');
            $this->Ln(20);
}
}   
    include '../php/conexion.php';
    $registro=mysqli_query($conexion,"SELECT numero_mesa,id_pedido,total,id_estado FROM tbl_pedido WHERE id_pedido=$idDelPedido") or die ('error con el dato');
    while($rowproducto =$registro->fetch_assoc()){
    $pdf = new PDF('P','pt',array(350,249));
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $idPedido = $rowproducto['id_pedido'];
    $sql = mysqli_query($conexion,"SELECT id_producto,cantidad FROM tbl_pedido_producto WHERE id_pedido=$idDelPedido");
    while($producto=mysqli_fetch_array($sql)){
    
    $idP = $producto['id_producto'];
    $selectP = mysqli_query($conexion,("SELECT nombre_producto,precio_producto FROM tbl_producto WHERE id_producto=$idP"));
    while($rowPro=mysqli_fetch_array($selectP)){
        
    $pdf->Cell(-23);
    $pdf->Cell(88,60,$rowPro['nombre_producto'],0,'','L');
    $pdf->Cell(50,60,$rowPro['precio_producto'],0,'','C');
    $pdf->Cell(50,60,$producto['cantidad'],0,'','C');
    $subtotal = $rowPro['precio_producto'] * $producto['cantidad'];
    $pdf->Cell(50,60,"$".$subtotal,0,'','C');
    $pdf->Ln(20);
    }}
    $pdf->SetFont('Arial','B',10);
    
    $pdf->Ln(50);
    $pdf->cell(-23);
    $pdf->cell(190,50,'Total',0,0,'L',0);
    $pdf->SetFont('Arial','',10);
    $pdf->cell(50,50,"$".$rowproducto['total'],0,0,'C','');
}
    $pdf->Output();
?>