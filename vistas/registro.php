<!DOCTYPE html>
<html>

<head>
  <title>Bardis || Registro</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Alata&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/registro.css">
  <script type="text/javascript" src="../js/validaciones.js"></script>
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
          <li><a href="iniciar_sesion.php">Inicio de sesión</a>
        </ul>
      </nav>
    </div>
    <div id="formulario">
      <div class="div-formulario-registro">
        <form id="formulario-1" action="../php/registrocliente.php" onsubmit="return validarRegistro()" method="post">
          <h3>Registro cliente</h3>
          <h5 id="alert"></h5>
          <input type="text" name="documentoCliente" id="documentoCliente" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Documento">
          <h5 id="alertDocumento"></h5>
          <input type="text" name="nombreCliente" id="nombreCliente" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre de usuario">
          <h5 id="alertNombre"></h5>
          <input type="email" name="correoCliente" id="correoCliente" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Correo">
          <h5 id="alertCorreo"></h5>
          <input type="text" name="edadCliente" id="edadCliente" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Edad">
          <h5 id="alertEdad"></h5>
          <input type="password" name="password" id="contrasena" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Clave" >
          <h5 id="alertContrasena"></h5>
          <input type="password" id="ConfirmarContrasena" name="confirmarPassword" id="confirmarContrasena" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Confirmar clave">
          <h5 id="alertConfirmarContrasena"></h5>
          <h5 id="alertContrasena2"></h5>
          <input type="submit" name="submitCliente">
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../js/registro.js">

  </script>
</body>

</html>