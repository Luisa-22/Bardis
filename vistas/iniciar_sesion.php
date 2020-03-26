<?php
include "../php/conexion.php";
include '../php/PHPmailer.php';
include '../php/SMTP.php';
include '../php/Exception.php';
include '../php/OAuth.php';

if (isset($_POST['submit'])) {

	$correo = $_POST['email'];
	$rol = $_POST['rol'];

	if ($rol == 'user') {
		$cliente = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `correo_cliente` = '$correo'");
		if (mysqli_num_rows($cliente) == 1) {
			$codigo = mysqli_fetch_array($cliente);
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigo['documento_cliente'];
			$mensaje = "<a href='$ruta'>Para cambiar tu contraseña da click aquí</a>";
		} else {
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

	if ($rol == 'admin') {
		$administrador = mysqli_query($conexion, "SELECT * FROM `tbl_administrador` where `correo_administrador` = '$correo'");
		if (mysqli_num_rows($administrador) == 1) {
			$codigoA = mysqli_fetch_array($administrador);
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigoA['cedula_administrador'];
			$mensaje = "<a href='$ruta'>Para cambiar tu contraseña da click aquí</a>";
		} else {
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

	if ($rol == '001') {
		$mesero = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `correo_empleado` = '$correo' and id_tipo_empleado = '001'");
		if (mysqli_num_rows($mesero) == 1) {
			$codigoE = mysqli_fetch_array($mesero);
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigoE['cedula_empleado'];
			$mensaje = "<a href='$ruta'>Para cambiar tu contraseña da click aquí</a>";
		} else {
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

	if ($rol == '002') {
		$dj = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `correo_empleado` = '$correo' and id_tipo_empleado = '002'");
		if (mysqli_num_rows($dj) == 1) {
			$codigoE = mysqli_fetch_array($dj);
			$ruta = 'localhost/Bardis/php/recuperarclave.php?codigo=' . $codigoE['cedula_empleado'];
			$mensaje = "<a href='$ruta'>Para cambiar tu contraseña da click aquí</a>";
		} else {
			echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
			echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
		}
	}

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
	$mail->addAddress($correo);
	$mail->Subject = "Cambiar contraseña";
	$mail->Body = $mensaje;
	$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
	$mail->IsHTML(true);

	if (!$mail->send()) {
		echo "Error al enviar el Email: " . $mail->ErrorInfo;
	} else {
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
			<nav>
				<img src="../logo/IconoLu17.png" alt="">
				<ul>
					<li><a href="../index.php">Inicio</a>
					</li>
					<li><a href="registro.php">Regístrate</a>
					</li>
					<li><a href="#contacto">Contáctanos</a></li>
					<li><a href="../vistas/iniciar_sesion.php">Inicio de sesión</a>
				</ul>
			</nav>
		</div>
		<div id="formulario">
			<div class="div-inicio-sesion">
				<form id="formulario-1" action="../php/iniciosesion.php" method="post">
					<h3>Iniciar sesión</h3>
					<input type="documento" name="documento" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Documento" required>
					<input type="password" name="password" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña" required>
					<select class="" name="rol">
						<option disabled selected>Rol</option>
						<option value="admin">Administrador</option>
						<option value="user">Cliente</option>
						<?php
						$query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");
						while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
						<?php
						}
						?>
					</select>
					<input type="submit" name="submit" value="Iniciar Sesión">
					<center><button type="button" name="" onclick="abrirpopup()">Recuperar contraseña</button></center>
				</form>
			</div>
		</div>
		<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<ion-icon name="close" onclick="cerrarpopup()" class="btn-cerrar-popup"></ion-icon>
				<div class="texto-popup">
					<h3>Recuperar contraseña</h3>
					<form class="" action="#" method="post">
						<select class="" name="rol">
							<option disabled selected>Rol</option>
							<option value="admin">Administrador</option>
							<option value="user">Cliente</option>
							<?php
							$query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");
							while ($row = mysqli_fetch_array($query)) {
							?>
								<option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
							<?php
							}
							?>
						</select>
						<input type="email" name="email" value="" placeholder="Correo"><br><br>
						<input type="submit" name="submit" value="Enviar correo">
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
	<script type="text/javascript">
		var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
			overlay = document.getElementById('overlay'),
			popup = document.getElementById('popup'),
			btnCerrarPopup = document.getElementById('btn-cerrar-popup');

		function abrirpopup() {
			overlay.classList.add('active');
			popup.classList.add('active');
		};

		function cerrarpopup() {
			overlay.classList.remove('active');
			popup.classList.remove('active');
		};
	</script>
</body>

</html>