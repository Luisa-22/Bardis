<?php
include '../php/conexion.php';
include "plantilla.php";
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';

if(isset($_POST['submit'])){

$nombreEventoPromocion = $_POST['nombreEventoPromocion'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$fechaFormato = date("$fecha");
$archivo = $_FILES['imagen'];
$imagen = $_FILES["imagen"]["name"];
$ruta = $_FILES["imagen"]["tmp_name"];
$destino="../img_eventos_promociones/".$imagen;
copy($ruta,$destino);

$ced_admin=$_POST['ced_admin'];


$registrarEventos = mysqli_query($conexion, "INSERT INTO `tbl_evento_promocion` (`nombre_evento_promocion`,
`descripcion_evento_promocion`,`fecha_evento_promocion`,`imagen_evento_promocion`,`cedula_administrador`)
VALUES('$nombreEventoPromocion', '$descripcion', '$fecha','$destino','$ced_admin')") or die (mysqli_error($conexion));


$query = mysqli_query($conexion, "SELECT `correo_cliente` FROM `tbl_cliente`");

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
/*
Enable SMTP debugging
0 = off (for production use)
1 = client messages
2 = client and server messages
*/
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "bardistech@gmail.com";
$mail->Password = "123bardis";
$mail->setFrom('bardistech@gmail.com', 'BARDIS');
while($correos = mysqli_fetch_array($query)){
    $mail->addAddress($correos['correo_cliente'],"<br>");
}
$mail->Subject = $nombreEventoPromocion;
$mail->Body ='<div style="width:100%; heigth:auto; padding:0 0 -60px 0;background:#000;border-radius:5px 5px 0 0;">
            <img src="cid:bar"  style="width:130px; height:90px; margin:0 0 0 410px;"></div>'
            .'<div style=" width:300px;height:auto; padding:20px; margin:0 0 0 300px;">
            <h3 style="font-size:20px;"><b>NUEVO EVENTO</b></h3>
            <h3 style="font-size:20px;">'.$nombreEventoPromocion .'</h3>'
            .'<h3 style="font-size:20px;">Descripción: '.$descripcion.'</h3>'
            .'<h3 style="font-size:20px;">Fecha: '.$fechaFormato.'</h3></div>';
$mail->AddEmbeddedImage('../logo/IconoLu17.png','bar');
$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
$mail->IsHTML(true);

if (!$mail->send())
{
	echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
}
else
{
	echo "Email enviado";
}
}
if($registrarEventos){
    echo "<script type='text/javascript'>alert('Se registró correctamente');</script>";
    echo "<script>window.location='../vistas/categoriaeventos.php';</script>";
}else{
    echo '<script language="javascript"> alert("No se pudo registrar correctamente,intente de nuevo");</script> ';
}
?>
