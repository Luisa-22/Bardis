<?php

/**
 * Se incluye la conexión de la base de datos
 */
include 'conexion.php';

/**
* Si se trae la cédula del usuario, la cuál se está enviando desde este mismo archvio
* entonces se permite continuar con la ejecución del código
*/
if (isset($_GET['codigo'])) {

  /**
   * Se crea la variable $id que almacena la cédula del usuario que se trajo por medio de la
   * variable 'codigo' de este mismo archivo
   * 
   * @var string $id          Cédula del usuario, tipo cadena de caracteres
   */
  $id = $_GET['codigo'];

  /**
   * Si se envia el formulario que se encuentra en este mismo archivo, se permite continuar
   * con la ejecucion del código
   */
  if (isset($_POST['submit'])) {

    /**
     * Se crea la variable $nuevaContraseña que almacena el campo que tiene como nombre 'nuevaPassword',
     * el cual se envia del formulario de recuperar contraseña del este mismo archivo
     * 
     * @var string $nuevaContraseña       Nueva clave usuario, tipo cadena de caracteres
     */
     $nuevaContraseña = $_POST['nuevaPassword'];
    
    /**
     * Se crea la variable $confirmarContraseña que almacena el campo que tiene como nombre 
     * 'confirmarPassword',el cual se envia del formulario de recuperar contraseña del este mismo archivo
     * 
     * @var string $confirmarContraseña   Confirmar clave usuario, tipo cadena de caracteres
     */ 
     $confirmarContraseña = $_POST['confirmarPassword'];

    /**
     * Se crea la variable $rol que almacena el campo que tiene como nombre 
     * 'rol',el cual se envia del formulario de recuperar contraseña del este mismo archivo 
     * 
     * @var string $rol                   Rol usuario, tipo cadena de caracteres
     */ 
     $rol = $_POST['rol'];

    /**
     * 
     * Si la variable $rol es igual a user 
     */
    if ($rol == 'user') {

      /**
       * Si la variable $nuevaContraseña es igual a $confirmarContraseña entonces hará lo sgte.
       */
      if ($nuevaContraseña == $confirmarContraseña) {

        /**
        * Se crea una variable para que almacene la nueva contraseña
        * 
        * @var string $contraseña       Nueva contraseña del usuario, tipo cadena de caracteres
        */
        $contraseña = $nuevaContraseña;

        /**
         * Se ejecuta la sentencia de actualizar en la tabla cliente para actualizar la clave del
         * cliente
         */
        $cliente = mysqli_query($conexion, "UPDATE `tbl_cliente` SET `clave_cliente` = '$contraseña' WHERE `documento_cliente` = '$id'");

        /**
         * 
         * Si se actualiza correctamente muestra una alerta y redirecciona a la vista para iniciar sesión
         */
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } 
      /**
       * De lo contrario
       */
      else {
        /**
         * Si no se actualiza nos muestra una alerta de error
         */
        "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }

    /**
    * 
    * Si la variable $rol es igual a admin
    */
    if ($rol == 'admin') {

      /**
       * Si la variable $nuevaContraseña es igual a $confirmarContraseña entonces hará lo sgte.
       */
      if ($nuevaContraseña == $confirmarContraseña) {

        /**
        * Se crea una variable para que almacene la nueva contraseña
        * 
        * @var string $contraseña       Nueva contraseña del usuario, tipo cadena de caracteres
        */
        $contraseña = $nuevaContraseña;

        /**
         * Se ejecuta la sentencia de actualizar en la tabla administrador para actualizar la clave del
         * administrador
         */        
        $administrador = mysqli_query($conexion, "UPDATE `tbl_administrador` SET `clave_administrador` = '$contraseña' WHERE `cedula_administrador` = '$id'");

        /**
         * 
         * Si se actualiza correctamente muestra una alerta y redirecciona a la vista para iniciar sesión
         */
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } 
      /**
      * De lo contrario
      */
      else {
        /**
         * Si no se actualiza nos muestra una alerta de error
         */
        echo "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }

    /**
     * 
     * Si la variable $rol es igual a 001,ese es el identificador del tipo empleado mesero en la base de datos
     */
    if ($rol == '001') {

      /**
       * Si la variable $nuevaContraseña es igual a $confirmarContraseña entonces hará lo sgte.
       */
      if ($nuevaContraseña == $confirmarContraseña) {

        /**
        * Se crea una variable para que almacene la nueva contraseña
        * 
        * @var string $contraseña       Nueva contraseña del usuario, tipo cadena de caracteres
        */
        $contraseña = $nuevaContraseña;

        /**
         * Se ejecuta la sentencia de actualizar en la tabla empleado para actualizar la clave del
         * empleado mesero
         */
        $mesero = mysqli_query($conexion, "UPDATE `tbl_empleado` SET `clave_empleado` = '$contraseña' WHERE `cedula_empleado` = '$id' and id_tipo_empleado = '001'");

        /**
         * 
         * Si se actualiza correctamente muestra una alerta y redirecciona a la vista para iniciar sesión
         */
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } 
      /**
      * De lo contrario
      */
      else {
        /**
         * Si no se actualiza nos muestra una alerta de error
         */
        echo "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }

    /**
     * 
     * Si la variable $rol es igual a 002,ese es el identificador del tipo empleado dj en la base de datos
     */
    if ($rol == '002') {
      
      /**
       * Si la variable $nuevaContraseña es igual a $confirmarContraseña entonces hará lo sgte.
       */
      if ($nuevaContraseña == $confirmarContraseña) {

        /**
        * Se crea una variable para que almacene la nueva contraseña
        * 
        * @var string $contraseña       Nueva contraseña del usuario, tipo cadena de caracteres
        */
        $contraseña = $nuevaContraseña;

        /**
         * Se ejecuta la sentencia de actualizar en la tabla empleado para actualizar la clave del
         * empleado dj
         */
        $dj = mysqli_query($conexion, "UPDATE `tbl_empleado` SET `clave_empleado` = '$contraseña' WHERE `cedula_empleado` = '$id' and  id_tipo_empleado = '002'");
        
        /**
         * 
         * Si se actualiza correctamente muestra una alerta y redirecciona a la vista para iniciar sesión
         */
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } else {
        /**
         * Si no se actualiza nos muestra una alerta de error
         */
        "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }
  }
} 
/**
 * Si no se envia la cédula de ningún usuario no se realiza nada, se permanece en el inicio de sesión
 */
else {
  header('location: ../vistas/iniciar_sesion.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/recuperarclave.css">
  <title>Recuperar contraseña</title>
</head>

<body>
  <div id="container">
    <div id="header">
      <ion-icon name="menu" id="icon-menu" onclick="menu()"></ion-icon>
      <nav>
        <img src="../logo/IconoLu17.png" alt="">
        <div id="">
          <ul id="nav-menu"><br>
            <li><a href="../index.php">Inicio</a>
            </li>
            <li><a href="../vistas/registro.php">Regístrate</a>
            </li>
            <li><a href="../vistas/iniciar_sesion.php">Inicio de sesión</a>
          </ul>
        </div>
      </nav>
    </div><br><br><br>
    <!--Se crea un div que contiene el formulario para recuperar la contraseña -->
    <div id="recuperarclave">
      <!--Se crea el formulario para recuperar la contraseña con su página de acción al 
        momento de enviar el formulario en este mismo archivo 
      -->
      <form action="#" method="post">
        <p>Recuperar contraseña</p>
        <!--Se coloca un select para que el usuario que va a recuperar su 
          contraseña coloque su rol 
        -->
        <select class="" name="rol">
          <option disabled selected>Rol</option>
          <option value="admin">Administrador</option>
          <option value="user">Cliente</option>
          <?php
          /**
           * Consulta a tabla tipo empleado
           * 
           * Se realiza la consulta '$query' a la tabla tipo empleado para mostrar toda la información
           * de los tipos de empleados existentes
           */
          $query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");

          /**
           * Mientras hayan resultados de la consulta, va a mostrar los tipos de empleados
           * existentes
           */
          while ($row = mysqli_fetch_array($query)) {
          ?>
            <!-- Se imprime los tipo de empleados, realizando el llamado a $row que es quién 
							almacena la información de la consulta $query
            -->
            <option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
          <?php
          /**
					* Se cierra el ciclo de la consulta de la tabla tipo_empleado
					*/
          }
          ?>
        </select>

        <!--Se colocan los campos que debe llenar el usuario para recuperar su clave -->
        <input type="password" name="nuevaPassword" id="" placeholder="Nueva contraseña">
        <input type="password" name="confirmarPassword" id="" placeholder="Confirmar contraseña">
        <input type="submit" name="submit" id="" value="Recuperar contraseña">
      </form>
    </div>
  </div>

</body>

</html>