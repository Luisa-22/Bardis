<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <?php
  include '../php/conexion.php';


  if ($_GET['evento_promocion']) {

    $id = $_GET['evento_promocion'];
    $evento_promocion = mysqli_query($conexion, "SELECT * FROM `tbl_evento_promocion` where `id_evento_promocion` = '$id'");
    $consulta = mysqli_num_rows($evento_promocion);
    $row = mysqli_fetch_array($evento_promocion);
    $idVerdadero = $row['id_evento_promocion'];

    if ($consulta == 0) {
      header('location: categoriaeventos.php');
    }
  } else {
    header('location: categoriaeventos.php');
  }

  if (isset($_POST['submit'])) {

    $id = $idVerdadero;
    $nombreEventoPromocion = $_POST['nombreEventoPromocion'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    $imagen = $_FILES["imagen"]["name"];
    $ruta = $_FILES["imagen"]["tmp_name"];
    $destino = "../img_eventos_promociones/" . $imagen;
    copy($ruta, $destino);


    $actualizar = mysqli_query($conexion, "UPDATE `tbl_evento_promocion` SET 
    `nombre_evento_promocion` ='$nombreEventoPromocion',
    `descripcion_evento_promocion` = '$descripcion', 
    `fecha_evento_promocion` = '$fecha' , `imagen_evento_promocion`= '$destino'
    WHERE `tbl_evento_promocion`.`id_evento_promocion` = '$id'");

    header('location: ../vistas/modificar_eventos_form.php');
  }
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/modificar_eventos_form.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Administrador-Modificar Evento</title>
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            $cedula = $_SESSION['administrador'];
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_administrador` where `cedula_administrador` = '$cedula'");
            $row = mysqli_fetch_array($query);
            $nombre = $row['nombre_administrador'];
            $apellido = $row['apellido_administrador'];
            ?>

            <h3><?php echo $nombre . " " . $apellido; ?>
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>
          <section id="section-opc">
            <ul>
              <li><a href="perfiladministrador.php">Inicio</a></li>
              <li><a href="mesas.php">Mesas</a></li>
              <li><a href="empleados.php">Empleados</a></li>
              <li><a href="modificardatos.php" target="_blank">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>

          </section>
        </div>
      </div>

      <a href="perfiladministrador.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <div class="formulario">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
          <?php foreach ($evento_promocion as $eventos_promociones) : ?>
            <h2>Modificar evento/promoción</h2>
            <input type="text" name="nombreEventoPromocion" value="<?php echo $eventos_promociones['nombre_evento_promocion']; ?>" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre del evento/promoción" required>

            <input type="text" name="descripcion" value="<?php echo $eventos_promociones['descripcion_evento_promocion']; ?>" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Descripción"></textarea>

            <input type="date" name="fecha" value="<?php echo $eventos_promociones['fecha_evento_promocion']; ?>">
            <br>
            <img src="<?php echo $eventos_promociones['imagen_evento_promocion']; ?>" width="100" , height="100">
            <input type="file" name="imagen">

            <input type="submit" name="submit" value="Actualizar">
          <?php
          endforeach
          ?>
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfildj.js">

    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>