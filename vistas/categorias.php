<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Categorias</title>
    <link rel="stylesheet" href="../css/categorias.css">
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
      <div id="div-cate" onclick="quitarsubmenu()">
        <div class="form-producto">
          <form action="../php/registrarproducto.php" method="post">
            <h2>Agregar producto</h2>
            <input type="hidden" name="ced_admin" value="<?php echo $_SESSION['administrador']; ?>">

            <input type="text" name="nombreProducto" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre" required>
            <input type="text" name="precioProducto" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Precio" required>
            <textarea name="descripcionProducto" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Descripción"></textarea>

            <select name="categoriaProducto">
              <option disabled selected>Categoria</option>

              <?php

              include "../php/conexion.php";

              $query = mysqli_query($conexion, "SELECT * FROM tbl_categoria");

              while ($row = mysqli_fetch_array($query)) {
              ?>
                <option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_categoria']; ?></option>
              <?php
              }

              ?>

            </select>

            <input type="submit" name="submit" value="Agregar producto">
          </form>
        </div>
        <div id="div-categorias">
          <div class="">
            <button><a href="categoriacerveza.php"><img src="../image/beer.png" title="Cerveza"><br></a>Cervezas</button>
          </div>
          <div class="">
            <button><a href="categoriacomida.php"><img src="../image/restaurant.png" tittle="Comidas"><br></a>Comidas</button>
          </div>
          <div class="">
            <button><a href="categoriawhisky.php"><img src="../image/whiskey.png"><br></a>Whiskeys</button>
          </div>
          <div class="">
            <button><a href="categoriarones.php"><img src="../image/rum.png"><br></a>Rones</button>
          </div>
          <div class="">
            <button><a href="categoriavinos.php"><img src="../image/wine.png"><br></a>Vinos</button>
          </div>
          <div class="">
            <button><a href="categoriashots.php"><img src="../image/shot.png"><br></a>Shots</button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/modificardatos.js"></script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>