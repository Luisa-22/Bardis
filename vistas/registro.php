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
        <form id="formulario-1" action="../php/registrocliente.php" method="post">
          <h3>Registro cliente</h3>
          <input type="text" name="documentoCliente" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Documento" required>
          <input type="text" name="nombreCliente" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre de usuario" required>
          <input type="email" name="correoCliente" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Correo" required>
          <input type="text" name="edadCliente" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Edad" required>
          <input type="password" name="password" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Clave" required>
          <input type="password" name="confirmarPassword" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Confirmar clave" required>
          <input type="submit" name="submitCliente">
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../js/registro.js">

  </script>
</body>

</html>