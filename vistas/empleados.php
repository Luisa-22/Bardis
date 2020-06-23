<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Se inicia la sesión
 */
session_start();

/**
 * Si la sesión del administrador está iniciada permite visualizar la siguiente vista
 */
if (isset($_SESSION['administrador'])) {

?>

  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Empleados</title>
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/empleados.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <!--Se coloca el logo del sistema-->
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <!--Se crea una sección que contiene la imagen de un usuario en general, el nombre y el 
            apellido del usuario que está en la sesión
          -->
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            /**
             * Traer el nombre del administrador
             * 
             * Se crea la variable cedula, para que almacene la sesion del administrador la cuál 
             * tiene el número de documento de tipo cadena de caracteres
             * 
             * @var string $cedula    Cédula del administrador
             */
            $cedula = $_SESSION['administrador'];

            /**
            * Consulta a la base de datos tabla administrador
            * 
            * Se realiza la consulta '$query' para traer el nombre y el apellido correspondiente al 
            * administrador que se encuentra en la sesión, en este caso necesitamos el nombre y el apellido, 
            * para lo cual creamos dos variables, el nombre y el apellido las cuales son de tipo cadena 
            * de caracteres
            * 
            * @var string $nombre      Nombre del administrador
            * @var string $apellido    Apellido del administrador
            */
            $query = mysqli_query($conexion, "SELECT nombre1_administrador, apellido1_administrador FROM `tbl_administrador` where `cedula_administrador` = '$cedula'");

            /**
             * En $row se almacena el resultado de la consulta $query
             */
            $row = mysqli_fetch_array($query);

            /**
             * Se le asigna el resultado de la consulta a la variable $nombre y $apellido
             */
            $nombre = $row['nombre1_administrador'];
            $apellido = $row['apellido1_administrador'];
            ?>

            <!--Luego en el echo se muestran las variables que almacena la información del nombre y
              apellido del administrador 
            -->
            <h3><?php echo $nombre . " " . $apellido; ?>

              <!--Se coloca el icono de una flecha hacia abajo para ver la otra sección con 
                otras opciones y se coloca el onclick correspondiente, el cuál ejecuta la función
                de mostrar esa sección.
              -->
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">

              <!--Se coloca el icono de una flecha hacia arriba para esconder la sección con
                opciones y se coloca el onclick correspondiente, el cuál ejecuta la función
                de esconder esa sección.
              -->
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>

          <!--Se crea la sección que se le muestra al usuario, la cuál tiene diferentes opciones -->
          <section id="section-opc">
            <ul>
              <li><a href="perfiladministrador.php">Inicio</a></li>
              <li><a href="empleados.php">Empleados</a></li>
              <li><a href="modificardatos.php" target="_blank">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>

      <!--Se crean dos div que contiene el formulario para registrar un empleado -->
      <div id="contenedor-empleados">
        <div class="form-empleados">
          <!--Se crea un formulario para registrar un empleado con su página de acción al momento de enviar 
            el formulario, en la carpeta php en el archivo registrar_empleado.php
          -->
          <form action="../php/registrar_empleado.php" method="post">
            <h2>Registro Mesero/DJ</h2>
            <!--Se almacena la cédula del administrador que está agregando al
              empleado en un input oculto
            -->
            <input type="hidden" name="ced_admin" value="<?php echo $_SESSION['administrador']; ?>">

            <!--En cada uno de los inputs se coloca:
                Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
                un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están 
                la carpeta js el archivo validaciones.js
            
              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input
            -->
            <input type="text" name="cedula" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Cédula">
            <input type="text" name="nombreEmpleado1" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Primer nombre">
            <input type="text" name="nombreEmpleado2" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Segundo nombre">
            <input type="text" name="apellidoEmpleado1" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Primer apellido">
            <input type="text" name="apellidoEmpleado2" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Segundo apellido">

            <!--Se coloca un select para que se le asigne un rol a un empleado -->
            <select class="" name="rol" required>
              <option value="">Seleccione un rol</option>
              <?php
              /**
							 * Consulta a tabla tipo empleado
							 * 
							 * Se realiza la consulta '$query' a la tabla tipo empleado para mostrar toda la información
							 * de los tipos de empleados existentes
							*/
              $query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");

              /**
						   * Mientras hayan resultados de esa consulta, se muestran los tipos de empleados
               * encontrados en la consulta $query y almacenados en $row
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

            <!-- En cada uno de los inputs se coloca:
                Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
                un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están 
                la carpeta js el archivo validaciones.js

              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input
            -->
            <input type="email" name="correoEmpleado" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Correo">
            <input type="text" name="celularEmpleado" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Celular">
            <input type="password" name="password" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña">
            <input type="password" name="confirmarPassword" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Confirmar contraseña">
            <input type="submit" name="submit" value="Enviar">
          </form>
        </div>

        <!--Se crea un div que contiene la tabla de los empleados-->
        <div class="tabla-empleados">
          <!--Se crea la tabla -->
          <table>
            <!--Cabecera de la tabla -->
            <thead>
              <!--Celdas de la tabla -->
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Cargo</th>
              <th colspan="2">Accion</th>
            </thead>
            <?php
              /**
							 * Consulta a tabla tipo empleado
							 * 
							 * Se realiza la consulta '$empleado' a la tabla tipo empleado para mostrar tofda la información
							 * de todos los empleados registrados
							*/
              $empleado = mysqli_query($conexion, "SELECT * FROM tbl_empleado");

              /**
						   * Mientras hayan resultados de esa consulta, se muestran los empleados
               * encontrados en la consulta $empleado y almacenados en $rowEmpleado
               */
              while ($rowEmpleado = mysqli_fetch_array($empleado)) {
            ?>
              <!--Cuerpo de la tabla -->
              <tbody>
                  <!--Fila de la tabla -->
                  <tr>
                    <!-- Se imprime los campos de un empleado en las celdas,
                      realizando el llamado a $rowEmpleado que es quién almacena
                      la información de la consulta $empleado
                    -->
                    <td><?php echo $rowEmpleado['cedula_empleado']; ?></td>
                    <td><?php echo $rowEmpleado['nombre1_empleado']; ?></td>
                    <td><?php echo $rowEmpleado['apellido1_empleado']; ?></td>

                    <td><?php echo $rowEmpleado['correo_empleado']; ?></td>
                    <td><?php echo $rowEmpleado['celular1_empleado']; ?></td>

                     <!--Se captura el tipo de empleado de un empleado en un input oculto-->
                    <input type="hidden" value="<?php echo $rowEmpleado['id_tipo_empleado']; ?>">

                    <?php
                    /**
                     * Traer el tipo de empleado
                     * 
                     * Se crea la variable id_tipo, para que almacene el id del tipo de empleado
                     * 
                     * @var string $id_tipo    Tipo de empleado cadena de caracteres
                     */
                    $id_tipo = $rowEmpleado['id_tipo_empleado'];

                    /**
                     * Consulta a tabla tipo empleado
                     * 
                     * Se realiza la consulta '$tipo' a la tabla tipo empleado para mostrar toda la información
                     * del tipo de empleado.
                     */
                    $tipo = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado WHERE id_tipo_empleado='$id_tipo'");

                    /**
						         * Mientras hayan resultados de esa consulta, se muestran los tipos de empleados
                     * encontrados en la consulta $tipo y almacenados en $rowTipo
                     */
                    while ($rowTipo = mysqli_fetch_array($tipo)) {
                    ?>
                      <!-- Se imprime el tipo de empleado que tiene un empleado en una celda,
                        realizando el llamado a $rowTipo que es quién almacena
                        la información de la consulta $tipo 
                      -->
                      <td><?php echo $rowTipo['tipo_empleado']; ?></td>
                      <td>
                      <!-- En la celda de la tabla se pone un enlace con un botón, el cuál al darle click 
                        por medio de la variable 'empleado' que es igual a la cédula del empleado se envia 
                        al archivo que está en la carpeta vistas en el archivo modificardatos_empleados.php,
                        el cuál permite modificar la información de ese empleado
                      -->
                        <a style="color:#fff;text-decoration: none;" class="enlace-btn" href="../vistas/modificardatos_empleados.php?empleado=<?php echo $rowEmpleado['cedula_empleado']; ?>">
                          <!--Botón para modificar empleado -->
                          <button class="btn-modificar">Modificar</a></button>

                      <!-- En la celda de la tabla se pone un enlace con un botón, el cuál al darle click 
                        por medio de la variable 'empleado' que es igual a la cédula del empleado se envia 
                        al archivo que está en la carpeta php en el archivo eliminarempleado.php, el cual 
                        permite eliminar ese empleado
                      -->
                        <a style="color:#fff;text-decoration: none;" href="../php/eliminarempleado.php?empleado=<?php echo $rowEmpleado['cedula_empleado']; ?>">
                          <!--Botón para eliminar empleado -->
                          <button class="btn-eliminar">Eliminar</a></button>
                      </td>
                  </tr>
              </tbody>
            <?php
            /**
						 * Se cierra el ciclo de la consulta de la tabla tipo_empleado
						 */
                    }
            ?>
          <?php
          /**
					 * Se cierra el ciclo de la consulta de la tabla empleado
					 */
            }
          ?>
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
/**
* Si no está la sesion del administrador lo que hace es que lleva al index
*/
header('location: ../index.php');
} ?>