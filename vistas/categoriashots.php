<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Shots</title>
    <link rel="stylesheet" href="../css/categoriashots.css">
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
      <a href="categorias.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <div class="tabla-producto">
        <table>
          <thead>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Descripción</th>
            <th>Acción</th>
          </thead>
          <?php

          include "../php/conexion.php";

          $producto = mysqli_query($conexion, "SELECT * FROM tbl_producto where `id_categoria`='C05'");

          while ($rowProducto = mysqli_fetch_array($producto)) {

          ?>
            <tbody>
              <form action="../php/registrarproducto.php" method="post">
                <tr>
                  <td><?php echo $rowProducto['id_producto']; ?></td>
                  <td><?php echo $rowProducto['nombre_producto']; ?></td>
                  <td><?php echo $rowProducto['precio_producto']; ?></td>
                  <td><?php echo $rowProducto['stock_producto']; ?></td>
                  <td><?php echo $rowProducto['descripcion_producto']; ?></td>
                  <td><a style="color:#fff;text-decoration: none;" class="enlace-btn" href="../vistas/modificarproductos.php?producto=<?php echo $rowProducto['id_producto']; ?>"><button class="btn-modificar">Modificar</a></button>

                    <a style="color:#fff;text-decoration: none;" href="../php/eliminarproducto.php?producto=<?php echo $rowProducto['id_producto']; ?>">
                      <button class="btn-eliminar">Eliminar</a></button></td>
                </tr>
              </form>
            </tbody>

          <?php
          }
          ?>

        </table>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js"></script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>