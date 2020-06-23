<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Se requieren los archivos para la libreria PHPMailer
 */
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';

/**
 * Si se envia el formulario que se encuentra en el archivo categoriaeventos.php hará lo sgte.
 */
if(isset($_POST['submit'])){

/**
 * Se crea la variable $nombreEventoPromocion que almacena el campo que tiene como nombre 
 * 'nombreEventoPromocion', el cual se envia del formulario del archivo categoriaeventos.php
 * 
 * @var string $nombreEventoPromocion       Nombre del evento_promocion, tipo cadena de caracteres
 */
 $nombreEventoPromocion = $_POST['nombreEventoPromocion'];

/**
 * Se crea la variable $descripcion que almacena el campo que tiene como nombre 
 * 'descripcion', el cual se envia del formulario del archivo categoriaeventos.php
 * 
 * @var string $descripcion                 Descripcion del evento_promocion, tipo cadena de caracteres
 */
 $descripcion = $_POST['descripcion'];

/**
 * Se crea la variable $fecha que almacena el campo que tiene como nombre 
 * 'fecha', el cual se envia del formulario del archivo categoriaeventos.php
 * 
 * @var date $fecha                         Fecha del evento_promoción, tipo fecha 
 */
 $fecha = $_POST['fecha'];
 
/**
 * Se crea la variable $fechaFormato donde se convierte a formato date la variable que almacena la fecha
 * 
 * @var date $fechaFormato                  Fecha del evento_promoción que se convierte a formato fecha
 */
 $fechaFormato = date("$fecha");

 /**
 * Se crea la variable $archivo que almacena el campo que tiene como nombre 
 * 'imagen', el cual se envia del formulario del archivo categoriaeventos.php
 * 
 * @var files $archivo                      Imagen del evento_promoción, tipo imagen
 */
 $archivo = $_FILES['imagen'];

/**
 * Se crea la variable $imagen donde se almacena el nombre de la imagen
 * 
 * @var files $imagen                       Nombre de la imagen del evento_promoción, tipo imagen
 */
 $imagen = $_FILES["imagen"]["name"];

/**
 * Se crea la variable $ruta donde se almacena la ruta de la imagen
 * 
 * @var files $ruta                         Ruta de la imagen del evento_promocion, tipo imagen
 */
 $ruta = $_FILES["imagen"]["tmp_name"];

/**
 * Se crea la variable $destino donde se almacena la ruta y la imagen que se almacenará en la base de datos
 * 
 * @var string $destino                     Destino de la imagen, tipo cadena de caracteres
 */
 $destino="../img_eventos_promociones/".$imagen;

/**
 *  Se crea la variable $ced_admin que almacena el campo que tiene como nombre 
 * 'ced_admin', el cual se envia del formulario del archivo categoriaeventos.php
 * 
 * @var string $ced_admin               Cédula del administrador que agrega el evento,tipo cadena de caracteres
 */
 $ced_admin=$_POST['ced_admin'];

/**
* Inserción tabla evento promoción
* 
* Se ejecuta la inserción del formulario de los eventos en la tabla evento_promocion con sus campos 
* correspondientes insertando cada variable que se creo para almacenar la
* información de cada campo del formulario
*/
$registrarEventos = mysqli_query($conexion, "INSERT INTO `tbl_evento_promocion` (`nombre_evento_promocion`,
`descripcion_evento_promocion`,`fecha_evento_promocion`,`imagen_evento_promocion`,`cedula_administrador`)
VALUES('$nombreEventoPromocion', '$descripcion', '$fecha','$destino','$ced_admin')");

/**
 * Consulta a tabla cliente
 * 
 * Se realiza la consulta '$query' en la tabla cliente para traer los correos de todos los clientes
 * que están registrados
 */
$query = mysqli_query($conexion, "SELECT `correo_cliente` FROM `tbl_cliente`");

/**
 * Se inicializa la librería PHPMailer para el envío de los correos
 */
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
/*
Enable SMTP debugging
0 = off (for production use)
1 = client messages
2 = client and server messages
*/

/**
 * Todas estas variables vienen por defecto en la librería y almacenan tanto los puertos como los 
 *  host de gmail
 */
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;

/**
 * Correo y contraseña del correo electrónico del emisor
 */
$mail->Username = "bardistech@gmail.com";
$mail->Password = "123bardis";

/**
 * Nombre y correo de contacto que recibe el receptor
 */
$mail->setFrom('bardistech@gmail.com', 'BARDIS');

/**
* Mientras hayan resultados de esa consulta, se muestran todos los 
* correo encontrados en la consulta $query y almacenados en $correos
*/
while($correos = mysqli_fetch_array($query)){
    $mail->addAddress($correos['correo_cliente'],"<br>");
}

/**
 * Asunto del correo
 */
$mail->Subject = "Nuevo Evento/Promoción - Bardis";

/**
 * Cuerpo del correo, con toda la información del evento/promoción
 */
$mail->Body = 'Estimado(a) usuario, se ha publicado un nuevo evento/promoción, a continuación
    se encuentra toda la información.' . '<br>' . '<br>'
    . 'Nombre: ' . $nombreEventoPromocion. '<br>' 
    . 'Descripción: ' . $descripcion . '<br>' 
    . 'Fecha: ' . $fechaFormato . '<br>' . '<br>'
    . 'Cordialmente' . '<br>'
    . 'El equipo de Bardis. ';

/**
 * Se utiliza la función AddAttachment para que permita enviar la imagen del evento/promoción
 */
$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->CharSet = 'UTF-8'; // Con esto funcionan los acentos
$mail->IsHTML(true);

/**
 * Si el correo no se envía, se imprime una alerta de error
 */
if (!$mail->send()){
    echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
}
/**
 * De lo contrario
 */
else{
    /**
	 * Si el correo se envía, se imprime una alerta de que se envió correctamente
	 */
	echo "<script type='text/javascript'>alert('Registro e email enviado correctamente');</script>";
}
}

/**
 * Si la variable $registrarEventos se realiza correctamente entonces muestra que se 
 * registró correctamente el evento y deja al usuario en la vista de categoriaeventos.php
 */
if($registrarEventos){
    echo "<script>window.location='../vistas/categoriaeventos.php';</script>";
}
/**
 * De lo contrario muestra que no se pudo registrar correctamente
 */
else{
    echo '<script language="javascript"> alert("No se pudo registrar correctamente,intente de nuevo");</script> ';
}
?>
