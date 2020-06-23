<?php

/**
 * Se incluye la conexión de la base de datos
 */
include "../php/conexion.php";

/**
 * Se requieren los archivos para la libreria PHPMailer
 */
include '../php/PHPmailer.php';
include '../php/SMTP.php';
include '../php/Exception.php';
include '../php/OAuth.php';

/**
* Si se envia el formulario para recuperar la contraseña que se encuentra en esta misma página hará lo sgte.
*/
if (isset($_POST['submit'])) {

	/**
	 * Se crea la variable $correo que almacena el campo que tiene como nombre 'email',
 	 * el cual se envia del formulario de este mismo archivo
	 * 
	 * @var string $correo		Correo del usuario que va a recuperar clave, tipo cadena de caracteres
	 */
	 $correo = $_POST['email'];

	/**
	 * Se crea la variable $rol que almacena el campo que tiene como nombre 'rol',
	 * el cual se envia del formulario de este mismo archivo
	 * 
	 * @var string $rol			Rol del usuario que va a recuperar clave, tipo cadena de caracteres
	 */ 
	 $rol = $_POST['rol'];

	/**
     * 
     * Si la variable $rol es igual a user 
     */
	if ($rol == 'user') {

		/**
		 * Consulta a la tabla cliente para traer toda la información del cliente
		 */
		$cliente = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `correo_cliente` = '$correo'");

		/**
		 * Si encuentra un resultado entonces hace lo sgte.
		 */
		if (mysqli_num_rows($cliente) == 1) {

			/**
             * En $codigo se almacena el resultado de la consulta $cliente
             */
			$codigo = mysqli_fetch_array($cliente);

			/**
			 * Se crea la variable $ruta que almacena la ubicación del archivo que se le envía al usuario 
			 * para cambiar su clave, el cual contiene el numero de documento del cliente, para el cual 
			 * realizan el llamado a $codigo que es quién almacena los resultados de la consulta $cliente
			 * 
			 * @var string $ruta		Ruta del archivo para cambiar la clave, tipo cadena de caracteres
			 */
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigo['documento_cliente'];

			/**
			 * Se crea la variable $mensaje que almacena un link con la ruta que dice para cambiar
			 * tu contraseña da click aquí
			 */
			$mensaje = "<a href='$ruta'>Para recuperar tu contraseña da click aquí</a>";
		} 
		/**
		 * De lo contrario 
		 */
		else {

			/**
			 * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
			 */
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

	/**
     * 
     * Si la variable $rol es igual a admin 
     */
	if ($rol == 'admin') {

		/**
		 * Consulta a la tabla cliente para traer toda la información del administrador
		 */
		$administrador = mysqli_query($conexion, "SELECT * FROM `tbl_administrador` where `correo_administrador` = '$correo'");

		/**
		 * Si encuentra un resultado entonces hace lo sgte.
		 */
		if (mysqli_num_rows($administrador) == 1) {

			/**
             * En $codigoA se almacena el resultado de la consulta $administrador
             */
			$codigoA = mysqli_fetch_array($administrador);

			/**
			 * Se crea la variable $ruta que almacena la ubicación del archivo que se le envía al usuario 
			 * para cambiar su clave, el cual contiene el numero de documento del administrador, para el cual 
			 * realizan el llamado a $codigoA que es quién almacena los resultados de la consulta $administrador
			 * 
			 * @var string $ruta		Ruta del archivo para cambiar la clave, tipo cadena de caracteres
			 */
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigoA['cedula_administrador'];

			/**
			 * Se crea la variable $mensaje que almacena un link con la ruta que dice para cambiar
			 * tu contraseña da click aquí
			 */
			$mensaje = "<a href='$ruta'>Para recuperar tu contraseña da click aquí</a>";
		} 
		/**
		 * De lo contrario
		 */
		else {

			/**
			 * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
			 */
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

	/**
     * 
     * Si la variable $rol es igual a 001, ese es el identificador del tipo empleado mesero en la base de datos
     */
	if ($rol == '001') {

		/**
		 * Consulta a la tabla empleado para traer toda la información del empleado
		 */
		$mesero = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `correo_empleado` = '$correo' and id_tipo_empleado = '001'");
		
		/**
		 * Si encuentra un resultado entonces hace lo sgte.
		 */
		if (mysqli_num_rows($mesero) == 1) {

			/**
             * En $codigoE se almacena el resultado de la consulta $mesero
             */
			$codigoE = mysqli_fetch_array($mesero);

			/**
			 * Se crea la variable $ruta que almacena la ubicación del archivo que se le envía al usuario 
			 * para cambiar su clave, el cual contiene el numero de documento del empleado, para el cual 
			 * realizan el llamado a $codigoE que es quién almacena los resultados de la consulta $mesero
			 * 
			 * @var string $ruta		Ruta del archivo para cambiar la clave, tipo cadena de caracteres
			 */
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigoE['cedula_empleado'];

			/**
			 * Se crea la variable $mensaje que almacena un link con la ruta que dice para cambiar
			 * tu contraseña da click aquí
			 */
			$mensaje = "<a href='$ruta'>Para recuperar tu contraseña da click aquí</a>";
		} 
		/**
		 * De lo contrario
		 */
		else {

			/**
			 * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
			 */
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

	/**
     * 
     * Si la variable $rol es igual a 002, ese es el identificador del tipo empleado dj en la base de datos
     */
	if ($rol == '002') {

		/**
		 * 
		 * Consulta a la tabla empleado para verificar la información del correo
		 */
		$dj = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `correo_empleado` = '$correo' and id_tipo_empleado = '002'");

		/**
		 * Si encuentra un resultado entonces hace lo sgte.
		 */
		if (mysqli_num_rows($dj) == 1) {

			/**
             * En $codigoE se almacena el resultado de la consulta $dj
             */
			$codigoE = mysqli_fetch_array($dj);

			/**
			 * Se crea la variable $ruta que almacena la ubicación del archivo que se le envía al usuario 
			 * para cambiar su clave, el cual contiene el numero de documento del empleado, para el cual 
			 * realizan el llamado a $codigoE que es quién almacena los resultados de la consulta $dj
			 * 
			 * @var string $ruta		Ruta del archivo para cambiar la clave, tipo cadena de caracteres
			 */
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigoE['cedula_empleado'];

			/**
			 * Se crea la variable $mensaje que almacena un link con la ruta que dice para cambiar
			 * tu contraseña da click aquí
			 */
			$mensaje = "<a href='$ruta'>Para recuperar tu contraseña da click aquí</a>";
		} 
		/**
		 * De lo contrario
		 */
		else {

			/**
			 * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
			 */
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

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
 	 * host de gmail
 	 */
	$mail->SMTPDebug = 0;
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
	 * Correo del receptor
	 */
	$mail->addAddress($correo);

	/**
	 * Asunto del correo
	 */
	$mail->Subject = "Recuperar contraseña - Bardis";

	/**
	 * Cuerpo del correo, el cual contiene el mensaje que le llega al usuario
	 */
	$mail->Body = 'Estimado(a) usuario, debido a que solicitó recuperar su contraseña, a continuación
		se encuentra el link para que pueda recuperar su contraseña.' . '<br>' . '<br>'
		. $mensaje . '<br>' . '<br>'
		. 'Cordialmente' . '<br>'
	 	. 'El equipo de Bardis. ';
	$mail->CharSet = 'UTF-8'; // Con esto funcionan los acentos
	$mail->IsHTML(true);

	/**
	 * 
	 * Si el correo no se envía, se imprime una alerta de error
	 */
	if (!$mail->send()) {
		echo "Error al enviar el Email: " . $mail->ErrorInfo;

	} 
	/**
	 * De lo contrario
	 */
	else {
		/**
		 * Si el correo se envía, se imprime una alerta de que se envió correctamente
		 */
		echo "<script type='text/javascript'>alert('Email enviado correctamente');</script>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
	<link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
	<link rel="stylesheet" href="../css/iniciar_sesion.css">
	<script type="text/javascript" src="../js/validaciones.js"></script>
	<title>Bardis || Inicia sesión</title>
</head>

<body>
	<div id="container">
		<div id="header">
			<!--Se crea el menú con el logo y los enlaces de navegación -->
			<nav>
				<img src="../logo/IconoLu17.png" alt="">
				<ul>
					<li><a href="../index.php">Inicio</a>
					</li>
					<li><a href="registro.php">Regístrate</a>
					</li>
					<li><a href="../vistas/iniciar_sesion.php">Inicio de sesión</a>
				</ul>
			</nav>
		</div>
		<!--Se crean varios div que contienen el formulario de inicio de sesión -->
		<div id="formulario">
			<div class="div-inicio-sesion">
				<!--Se crea un formulario para iniciar sesión con su página de acción al momento de enviar 
            		el formulario, en la carpeta php en el archivo iniciosesion.php y se coloca el evento 
            		onsubmit en el formulario para que en el momento que se envie se
            		valide en el archivo validaciones.js el inicio de sesión
          		-->
				<form id="formulario-1" action="../php/iniciosesion.php" onsubmit="return validarInicioSesion()" method="post">
					<h3>Iniciar sesión</h3>
					<h5 id="alert"></h5>
					<!--En cada uno de los inputs se coloca:
              			Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              			un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están 
						en la carpeta js el archivo validaciones.js

						Onpaste="" la función de este es no permitir copiar y pegar texto en ese input

						Cada uno de los campos que se le solicitan al usuario tienen un encabezado h5 con un id de 
            			alerta para cada campo, la funcion de cada uno de esos es mostrar la alerta correspondiente 
            			llegado el caso que el usuario intente enviar el formulario con algun campo vacio
            			que sea obligatorio
            		-->
					<input type="documento" id="documento" name="documento" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Documento">
					<h5 id="alertDocumento"></h5>
					<input type="password" id="contrasena" name="password" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña" >
					<h5 id="alertContrasena"></h5>
					<!--Se coloca un select para que el usuario coloque su rol -->
					<select class="" id="rol" name="rol">
						<option value="rol">Seleccione su rol</option>
						<option value="admin">Administrador</option>
						<option value="user">Cliente</option>
						<?php

						/**
						 * Consulta a tabla tipo empleado
						 * 
						 * Se realiza la sentencia select a la tabla tipo empleado para mostrar los tipos de 
           				 * empleados existentes
						 */
						$query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");
						while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
						<?php
						}
						?>
					</select>
					<h5 id="alertRol"></h5>

					<!--Se coloca el input submit para que se envie el formulario-->
					<input type="submit" name="submit" value="Iniciar Sesión">

					<!--Se muestra un botón que al darle click ejecuta una función javascript de
						abrir una ventana para recuperar contraseña 
					-->
					<center><button type="button" name="" onclick="abrirpopup()">Recuperar contraseña</button></center>
				</form>
			</div>
		</div>
		<!--Se crean varios div que contienen el formulario de recuperar contraseña -->
		<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<!--Se coloca icono de una 'x' para cerrar la ventana, el cuál ejecuta una función
					de javascript al darle click
				-->
				<ion-icon name="close" onclick="cerrarpopup()" class="btn-cerrar-popup"></ion-icon>
				<div class="texto-popup">
					<h3>Recuperar contraseña</h3>
					<!--Se crea el formulario de recuperar contraseña con su página accion en este mismo
						archivo y se coloca el evento onsubmit en el formulario para que en el momento que 
						se envie se valide en el archivo validaciones.js el recuperar contraseña
					-->
					<h5 id="alertContrasena2"></h5>
					<form class="" action="#" method="post" onsubmit=" return validarRecuperarContrasena()">
						<!--Se coloca un select para que el usuario que quiere recuperar su 
						contraseña coloque su rol -->
						<select class="" id="rolRecuperarContrasena" name="rol">
							<option value="rolcontrasena">Seleccione su rol</option>
							<option value="admin">Administrador</option>
							<option value="user">Cliente</option>
							<?php
							/**
							 * Consulta a tabla tipo empleado
							 * 
							 * Se realiza la consulta '$query' a la tabla tipo empleado para mostrar toda la
							 * información de los tipos de empleados existentes
							*/
							$query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");

							/**
							 * Mientras hayan resultados de esa consulta, se muestran los tipos de empleados
                 			 * encontrados en la consulta $query y almacenados en $row
               				 */
							while ($row = mysqli_fetch_array($query)) {
							?>
								<!-- Se imprime los tipo de empleados, realizando el llamado a $row que es quién 
									almacena la información de la consulta $query
                            	-->
								<option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
							<?php
							/**
						 	 * Se cierra el ciclo de la consulta de la tabla tipo_empleado
						 	 */
							}
							?>
						</select>
						<h5 id="alertRecuperarContrasena"></h5>
						<input type="email" id="correoRecuperarContrasena" name="email" value="" placeholder="Correo"><br>
						<h5 id="alertCorreo"></h5>
						<!--Se coloca el input submit para que se envie el formulario-->
						<input type="submit" name="submit" value="Enviar correo">
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
	<script type="text/javascript">
		/**
		Se obtiene el botón 'btn-abrir-popup',se obtine el div 'overlay', 'popup','btnCerrarPopup' y 
		se guarda en la variable btnAbrirPopup

		@var btnAbrirPopup
		*/
		var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
			overlay = document.getElementById('overlay'),
			popup = document.getElementById('popup'),
			btnCerrarPopup = document.getElementById('btn-cerrar-popup');

		/**
		Se crea la función abrirpopup que es la que muestra los elementos que hay dentro de 'overlay' 
		*/
		function abrirpopup() {
			/**
			Se activa el div 'overlay' agregandole un 'active'
			*/
			overlay.classList.add('active');
			/**
			Se activa el div popup agregandole un 'active'
			*/
			popup.classList.add('active');
		};

		/**
		Se crea la función cerrarpopup que es la que no permitira cerrar las ventas 'overlay' y 'popup' 
		*/
		function cerrarpopup() {
			/**
			Se remueve el active del div 'overlay'
			*/
			overlay.classList.remove('active');
			/**
			Se remueve el active del div 'popup'
			*/
			popup.classList.remove('active');
		};
	</script>
</body>

</html>