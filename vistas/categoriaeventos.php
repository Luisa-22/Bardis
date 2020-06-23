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
    <title>Bardis || Administrador-Eventos</title>
    <link rel="stylesheet" href="../css/categoriaeventos.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
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

      <!--Se pone un enlace para volver a la pestaña del perfil -->
      <a href="perfiladministrador.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <!--Se crean varios div que contienen el formulario para agregar un evento -->
      <div id="eventos">
        <div id="form-eventos">
          <!--Se crea un formulario para agregar un evento con su página de acción al momento de enviar 
            el formulario, en la carpeta php en el archivo registrarevento.php y se coloca el evento 
            onsubmit en el formulario para que en el momento que se envie se
            valide en el archivo validaciones.js el registro del evento
          -->
          <form action="../php/registrarevento.php" onsubmit="return validarFormularioEvento()" method="post" enctype="multipart/form-data">
            <h2>Publicar evento/promoción</h2>
            <h5 id="alertEvento"></h5>
            <!--Se captura la cédula del administrador que está agregando el evento, en un input oculto.-->
            <input type="hidden" name="ced_admin" value="<?php echo $_SESSION['administrador']; ?>">

            <!--En algunos de los inputs se coloca:
              Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están en
              la carpeta js el archivo validaciones.js

              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input

              Cada uno de los campos que se le solicitan al usuario tienen un encabezado h5 con un id de 
              alerta para cada campo, la funcion de cada uno de esos es mostrar la alerta correspondiente 
              llegado el caso que el usuario intente enviar el formulario con algun campo vacio
              que sea obligatorio
            -->
            <input type="text" id="nombreEvento" name="nombreEventoPromocion" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre del evento/promoción">
            <h5 id="alertNombreEvento"></h5>
            <textarea name="descripcion" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Descripción"></textarea>
            <input id="fechEvento" type="date" name="fecha">
            <h5 id="alertFecha"></h5>
            <input type="file" name="imagen">

            <!--Se coloca el input submit para que se envie el formulario-->
            <input type="submit" name="submit" value="Publicar evento">
          </form>
        </div>

        <!--Se crea un div para mostrar los eventos -->
        <div id="nombre-eventos">
          <?php
          /**
           * Consulta a la base de datos tabla evento promoción
           * 
           * Se ejecuta la consulta '$evento_promocion' a la tabla evento promocion para que me muestre toda
           * la información de los eventos se hayan publicado
           */
          $evento_promocion = mysqli_query($conexion, "SELECT * FROM tbl_evento_promocion");

          /**
           * Mientras hayan resultados de esa consulta, se muestra toda la información de los 
           * eventos encontrados en la consulta $evento_promocion y almacenados en $rowEvento_promocion
           */
          while ($rowEvento_promocion = mysqli_fetch_array($evento_promocion)) {
          ?>
            <!--Se crean dos div para poner la imagen del evento_promoción -->
            <div class="carta-evento">
              <div class="img-evento">
                  <!-- Se imprime cada uno de los campos de un evento,
                    realizando el llamado a $rowEvento_promocion que es quién almacena
                    la información de la consulta $evento_promocion
                  -->
                <?php echo '<img src="' . $rowEvento_promocion["imagen_evento_promocion"] . '" >'; ?>
              </div>
              <!--Se crea un div para colocar el resto de la información del evento_promoción -->
              <div class="body-evento">
                <h4>Nombre:</h4><?php echo $rowEvento_promocion['nombre_evento_promocion']; ?>
                <h4>Descripción:</h4><?php echo $rowEvento_promocion['descripcion_evento_promocion']; ?>
                <h4>Fecha:</h4><?php echo $rowEvento_promocion['fecha_evento_promocion']; ?>
              </div>
              <!--Se crea un div para colocar el botón eliminar -->
              <div class="footer-evento">

                <!-- Se pone un enlace con un botón, el cuál al darle click 
                  por medio de la variable 'evento_promocion' que es igual al id del evento se envia 
                  al archivo que está en la carpeta php en el archivo eliminarevento.php, el cual 
                  permite eliminar ese empleado
                -->
                <a style="color:#fff;text-decoration: none;" href="../php/eliminarevento.php?evento_promocion=<?php echo $rowEvento_promocion['id_evento_promocion']; ?>">
                  
                <!--Botón para aliminar -->
                <button class="btn-eliminar">Eliminar</a></button>
              </div>
            </div>
          <?php
          /**
           * Se cierra el ciclo de la consulta de la tabla evento_promoción
           */
          }
          ?>
        </div>
      </div>
    </div>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js"></script>   
  </body>

  </html>

<?php } else {
  /**
   * Si no está la sesión del administrador lo que hace es que lleva al index
   */
  header('location: ../index.php');
} ?>