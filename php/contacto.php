<?php 

/**
 * Se incluye la conexión de la base de datos
 */
include 'conexion.php';


/**
 * Se requieren los archivos para la libreria PHPMailer
 */
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';


/**
 * Si se envia el formulario que se encuentra en el archivo index.php hará lo sgte.
 */
if(isset($_POST['submit'])){

/**
 * Se crea la variable $nombres que almacena el campo que tiene como nombre 'nombres',
 * el cual se envia del formulario del archivo index.php
 *  
 * @var string $nombres		    Nombres del cliente tipo cadena de caracteres
 */
 $nombres = $_POST['nombres'];

/**
 * Se crea la variable $apellidos que almacena el campo que tiene como nombre 'apellidos',
 * el cual se envia del formulario del archivo index.php
 * 
 * @var string $apellidos		Apellidos del cliente tipo cadena de caracteres
 */ 
 $apellidos = $_POST['apellidos'];
 
/**
 * Se crea la variable $correo que almacena el campo que tiene como nombre 'correo',
 * el cual se envia del formulario del archivo index.php
 * 
 * @var string $correo			Correo del cliente tipo cadena de caracteres
 */
 $correo = $_POST['correo']; 

/**
 * Se crea la variable $mensaje que almacena el campo que tiene como nombre 'mensaje',
 * el cual se envia del formulario del archivo index.php
 * 
 * @var string $mensaje			Mensaje del cliente tipo cadena de caracteres
 * 
 */ 
 $mensaje = $_POST['mensaje'];

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
 * Correo de quién recibe la información.
 */
$mail->addAddress('contactobardis@gmail.com');


/**
 * Asunto del correo
 */
$mail->Subject = 'Formulario de Contacto';

/**
 * Cuerpo del mensaje, con toda la información del contacto del usuario
 */
$mail->Body = 'Nombre: ' . $nombres. '<br>' 
    . 'Apellidos: ' . $apellidos . '<br>' 
    . 'Correo: ' . $correo . '<br>' 
    . 'Mensaje: '. $mensaje;
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
    echo "<script type='text/javascript'>alert('Email enviado correctamente, pronto estaremos en contacto');</script>";
    echo "<script>window.location='../index.php';</script>"; 
}
}

?>

