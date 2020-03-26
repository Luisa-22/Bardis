<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Música</title>
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/musica.css">
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
            header('Refresh:5; url=musica.php');
            ?>

            <h3><?php echo $nombre . " " . $apellido;  ?>
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
      <div id="div-music" onclick="quitarsubmenu()">
        <div id="musica">
          <table class="table-music">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Artista</th>
                <th>Canciones sonadas</th>
              </tr>
            </thead>


            <tbody>
              <tr>
                <form method="post">
                  <?php
                  include "../php/conexion.php";

                  $musica = mysqli_query($conexion, "SELECT * FROM tbl_cancion");

                  while ($rowMusica = mysqli_fetch_array($musica)) {
                    echo '<tr>
                  <td>' . $rowMusica['nombre_cancion'] . '</td>
                  <td>' . $rowMusica['nombre_interprete'] . '</td>
                  <td colspan=""><input type="checkbox" id="' . $rowMusica['id_cancion'] . '" name="id_canciones[]" value="' . $rowMusica['id_cancion'] . '"/>
                  <label class"label-checkbox" for="' . $rowMusica['id_cancion'] . '"><span></span></label></td>
                  </tr>';
                  }
                  ?>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" style="padding:5px 20px 0 0;">
                  <input name="eliminar-cancion" type="submit" value="Canciones sonadas" class="eliminar-cancion" />
                </td>
              </tr>
            </tfoot>
            <?php
            if (isset($_POST['eliminar-cancion'])) {
              if (empty($_POST['id_canciones'])) {
                echo "<script type='text/javascript'>alert('Ninguna canción seleccionada');</script>";
              } else {

                foreach ($_POST['id_canciones'] as $id_borrar) {
                  $borrarCancion = mysqli_query($conexion, "DELETE FROM tbl_cancion WHERE id_cancion='$id_borrar'");
                  header('Location: musica.php');
                }
              }
            }
            ?>
            </form>
          </table>
        </div>

      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js">
    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>