<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['mesero']) {

  $where = '';

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $categoria = mysqli_query($conexion, "SELECT id_categoria FROM `tbl_categoria` WHERE id_categoria = '$id'");
    $rowCat = mysqli_fetch_array($categoria);
    $idCat = $rowCat['id_categoria'];
    $where = "WHERE id_categoria = '$idCat'";
  }

  $consultarProductos = mysqli_query($conexion, "SELECT * FROM `tbl_producto` $where");
  $cont = mysqli_num_rows($consultarProductos);
  $i = 0;

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Categorias</title>
    <link rel="stylesheet" href="../css/categorianueva.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            $cedula = $_SESSION['mesero'];
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `cedula_empleado` = '$cedula'");
            $row = mysqli_fetch_array($query);
            $nombre = $row['nombre_empleado'];
            $apellido = $row['apellido_empleado'];
            ?>
            <h3><?php echo $nombre . " " . $apellido;  ?>
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>
          <section id="section-opc">
            <ul>
              <li><a href="perfilmesero.php">Inicio</a></li>
              <li><a href="cambiarclavemesero.php">Cambiar contraseña</a></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>
      <a href="perfilmesero.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <div id="div-categorias">
        <div class="">
          <div class="realizar-pedidos">
            <h2>Realizar pedidos</h2>
            <div class="btn-categorias">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <select name="id" id="id">
                  <option disabled selected value="">Categorias</option>
                  <?php
                  $query = mysqli_query($conexion, "SELECT * FROM tbl_categoria");
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                    <option value="<?php echo $row['id_categoria']; ?>"> <?php echo $row['nombre_categoria']; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <button type="submit">Buscar<img src="../icons/search.png"></button>
              </form>
            </div>
            <div class="tabla-producto">
              <table>
                <thead>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Descripción</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                  while ($cont > $i) {
                    $row = mysqli_fetch_array($consultarProductos);
                  ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <tr>
                        <td><?php echo $row['id_producto']; ?></td>
                        <td><?php echo $row['nombre_producto']; ?></td>
                        <td><?php echo $row['precio_producto']; ?></td>
                        <td><?php echo $row['descripcion_producto']; ?></td>
                        <td>
                          <a id="agregar-producto" href="vercarrito.php?id=<?php echo $row['id_producto']; ?>">Agregar</a>
                        </td>
                      </tr>
                    <?php
                    $i = $i + 1;
                  }
                    ?>
                    </form>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="tabla-pedido">
          <div><object id="carrito" width="30" height="30" data="../icons/supermarket.svg" type="image/svg+xml"></object></div>
          <div><a href="../vistas/vercarrito.php">Pedidos</a></div>
        </div>
      </div>
    </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfilmesero.js"></script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>