<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Eventos</title>
    <link rel="stylesheet" href="../css/categoriaeventos.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
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
      <div id="eventos">
        <div id="form-eventos">
          <form action="../php/registrarevento.php" method="post" enctype="multipart/form-data">
            <h2>Publicar evento/promoción</h2>
            <input type="hidden" name="ced_admin" value="<?php echo $_SESSION['administrador']; ?>">

            <input type="text" name="nombreEventoPromocion" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre del evento/promoción" required>
            <textarea name="descripcion" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Descripción"></textarea>
            <input type="date" name="fecha" required>
            <input type="file" name="imagen">
            <input type="submit" name="submit" value="Publicar evento">
          </form>
        </div>
        <div id="nombre-eventos">
          <?php

          include "../php/conexion.php";

          $evento_promocion = mysqli_query($conexion, "SELECT * FROM tbl_evento_promocion");

          while ($rowEvento_promocion = mysqli_fetch_array($evento_promocion)) {

          ?>
            <div class="carta-evento">
              <div class="img-evento">
                <?php echo '<img src="' . $rowEvento_promocion["imagen_evento_promocion"] . '" >'; ?>
              </div>
              <div class="body-evento">
                <h4>Nombre:</h4><?php echo $rowEvento_promocion['nombre_evento_promocion']; ?>
                <h4>Descripción:</h4><?php echo $rowEvento_promocion['descripcion_evento_promocion']; ?>
                <h4>Fecha:</h4><?php echo $rowEvento_promocion['fecha_evento_promocion']; ?>
              </div>
              <div class="footer-evento">
                <a style="color:#fff;text-decoration: none;" href="../vistas/modificar_eventos_form.php?evento_promocion=<?php echo $rowEvento_promocion['id_evento_promocion']; ?>">
                  <button class="btn-modificar">Modificar</a></button>
                <a style="color:#fff;text-decoration: none;" href="../php/eliminarevento.php?evento_promocion=<?php echo $rowEvento_promocion['id_evento_promocion']; ?>">
                  <button class="btn-eliminar">Eliminar</a></button>
              </div>
            </div>
          <?php
          }
          ?>
        </div>

      </div>
    </div>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/categoriaeventos.js">

    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>