<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <?php
  include '../php/conexion.php';


  if ($_GET['producto']) {

    $id = $_GET['producto'];

    $producto = mysqli_query($conexion, "SELECT * FROM `tbl_producto` where `id_producto` = '$id'");

    $consulta = mysqli_num_rows($producto);

    if ($consulta == 0) {
      header('location: categorias.php');
    }
  } else {
    header('location: categorias.php');
  }

  if (isset($_POST['submit'])) {

    $codigoProducto = $_POST['codigoProducto'];
    $nombreProducto = $_POST['nombreProducto'];
    $precioProducto = $_POST['precioProducto'];
    $cantidadProducto = $_POST['cantidadProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $categoriaProducto = $_POST['categoriaProducto'];


    $actualizar = mysqli_query($conexion, "UPDATE `tbl_producto` SET  `nombre_producto` = '$nombreProducto',
    `precio_producto` = '$precioProducto', `stock_producto` = '$cantidadProducto' , `descripcion_producto`= '$descripcionProducto'
    WHERE `tbl_producto`.`id_producto` = '$id'");
    header('location: modificarproductos.php');
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
    <link rel="stylesheet" href="../css/modificardatos.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Administrador-Modificar Productos</title>
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
      <div class="div-modificar-perfil" id="modificar-perfil" onclick="quitarsubmenu()">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <?php foreach ($producto as $productos) : ?>
            <h2>Modificar producto</h2>
            <input type="text" name="nombreProducto" onkeypress="return SoloLetras(event)" onpaste="return false" value="<?php echo $productos['nombre_producto']; ?>" placeholder="Nombre">
            <input type="text" name="precioProducto" onkeypress="return SoloNumeros(event)" onpaste="return false" value="<?php echo $productos['precio_producto']; ?>" placeholder="Precio">
            <input type="number" name="cantidadProducto" onkeypress="return SoloNumeros(event)" onpaste="return false" value="<?php echo $productos['stock_producto']; ?>" placeholder="Cantidad de producto">
            <input type="text" name="descripcionProducto" onkeypress="return SoloLetras(event)" onpaste="return false" value="<?php echo $productos['descripcion_producto']; ?>" placeholder="Descripción">
            <input type="submit" name="submit" value="Actualizar">
          <?php
          endforeach
          ?>
      </div>
      </form>
    </div>


    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/modificardatos.js">

    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>