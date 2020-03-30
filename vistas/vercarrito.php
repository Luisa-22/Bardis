<?php
include '../php/conexion.php';
session_start();
//Si existe la sesion del mesero haga lo sgte.
if ($_SESSION['mesero']) {
  //Si la session del carrito existe entonces me va a traer unos datos, pero lo primero que se llena
  // es si el carrito no existe porque se tiene que inicializar
  //para poder inicializar se debe validar si trae algún dato por la url que es el id, si no trae no hace nada
  if (isset($_SESSION['carrito'])) {
    if (isset($_GET['id'])) {
      $arreglo = $_SESSION['carrito'];
      $encontro = false;
      $posicion = 0;
      for ($i = 0; $i < count($arreglo); $i++) {
        if ($arreglo[$i]['Id'] == $_GET['id']) {
          $encontro = true;
          $posicion = $i;
        }
      }
      if ($encontro == true) {
        $arreglo[$posicion]['Cantidad'] += 1;
      } else {
        $id = $_GET['id'];
        $nombre = "";
        $precio = 0;
        $productoC = mysqli_query($conexion, "SELECT * FROM tbl_producto WHERE id_producto = '$id'");
        while ($rowC = mysqli_fetch_array($productoC)) {
          $nombre = $rowC['nombre_producto'];
          $precio = $rowC['precio_producto'];
        }
        $arregloNuevo = array(
          'Id' => $id,
          'Nombre' => $nombre,
          'Precio' => $precio,
          'Cantidad' => 1
        );
        array_push($arreglo, $arregloNuevo);
      }
      $_SESSION['carrito'] = $arreglo;
    }
  } else {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $nombre = "";
      $precio = 0;
      $productoC = mysqli_query($conexion, "SELECT * FROM tbl_producto WHERE id_producto = '$id'");
      while ($rowC = mysqli_fetch_array($productoC)) {
        $nombre = $rowC['nombre_producto'];
        $precio = $rowC['precio_producto'];
      }
      $arreglo[] = array(
        'Id' => $id,
        'Nombre' => $nombre,
        'Precio' => $precio,
        'Cantidad' => 1
      );
      $_SESSION['carrito'] = $arreglo;
    }
  }
?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Ver pedido</title>
    <link rel="stylesheet" href="../css/vercarrito.css">
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
            <h3><?php echo $nombre . " " . $apellido; ?>
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
      <a href="categoriasnuevas.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <div class="tabla-pedido">
        <div class="pedido">
          <center>
            <h2>Pedido</h2>
          </center>
          <table>
            <thead>
              <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
              <tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (isset($_SESSION['carrito'])) {
                $datos = $_SESSION['carrito'];
                //Lo que se hace es que se hace un ciclo para i que inicia en 0 hasta que i sea menor a ese count.
                //El count me sirve para mirar el # de resultados de ese arreglo(datos).
                for ($i = 0; $i < count($datos); $i++) {
              ?>
                  <tr>
                  <!-- Acá se dice que me muestre lo que hay en ese arreglo, en esa posicion asociado a ese campo -->
                    <td><?php echo $datos[$i]['Nombre'] ?></td>
                    <td><?php echo "$" . $datos[$i]['Precio'] ?></td>
                    <td><input type="number" value="<?php echo $datos[$i]['Cantidad'] ?>"></td>
                    <td><?php echo "$" . $datos[$i]['Precio'] * $datos[$i]['Cantidad'] ?></td>
                    <td>
                      <a href="../php/eliminardecarrito.php?Id=<?php echo $datos[$i]['Id'];?>">
                        Eliminar</a>
                    </td>
                  </tr>
              <?php
                  //Total += es igual a total mas el subtotal
                  $total += ($datos[$i]['Precio'] * $datos[$i]['Cantidad']);
                }
              } else {
                echo "El pedido está vacío";
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <td><a href="categoriasnuevas.php"><input type="submit" value="Volver" /></a></td>
                <form action="../php/enviarcarrito.php" method="post">
                  <td>Total:<?php echo $total; ?></td>
                  <td><select name="mesa">
                      <option disabled selected>Mesa</option>
                      <?php
                      $query = mysqli_query($conexion, "SELECT * FROM tbl_mesa");
                      while ($row = mysqli_fetch_array($query)) {
                      ?>
                        <option value="<?php echo $row['numero_mesa']; ?>"><?php echo $row['numero_mesa']; ?></option>
                      <?php
                      }
                      ?>
                    </select></td>
                  <input type="hidden" name="total_p" value="<?php echo $total; ?>">
                  <input type="hidden" name="ced_mesero" value="<?php echo $_SESSION['mesero']; ?>">
                  <td><input type="submit" name="enviar" value="Enviar"></td>
                </form>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      <script type="text/javascript" src="../js/perfilmesero.js"></script>
  </body>

  </html>
<?php
} else {
  header('location: ../index.php');
} ?>