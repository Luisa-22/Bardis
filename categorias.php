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
    <title>Bardis || Administrador-Categorias</title>
    <link rel="stylesheet" href="../css/categorias.css">
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
      <!--Se crean varios div que contienen el formulario para agregar producto y se coloca el
          evento onsubmit en el formulario para que en el momento que se envie se valide en el archivo 
          validaciones.js el registro del producto -->
      <div id="div-cate" onsubmit="return validarRegistroDeProductos()" onclick="quitarsubmenu()">
        <div class="form-producto">
          <!--Se crea un formulario para agregar un producto con su página de acción al momento de enviar 
            el formulario, en la carpeta php en el archivo registrarproducto.php 
          -->
          <form action="../php/registrarproducto.php" method="post">
            <h2>Agregar producto</h2>
            <h5 id="alert"></h5>
           
              <!--Se almacena la cedula del administrador que está agregando los
                productos en un input oculto
              -->
            <input type="hidden" name="ced_admin" value="<?php echo $_SESSION['administrador']; ?>">

            <!-- En cada uno de los inputs se coloca:
              Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están en
              la carpeta js el archivo validaciones.js

              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input

              Cada uno de los campos que se le solicitan al usuario tienen un encabezado h5 con un id de 
              alerta para cada campo, la funcion de cada uno de esos es mostrar la alerta correspondiente 
              llegado el caso que el usuario intente enviar el formulario con algun campo vacio
              que sea obligatorio
            -->
            <input type="text" id="nombreProducto" name="nombreProducto" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre">
            <h5 id="alertNombre"></h5>
            <input type="text" id="precioProducto" name="precioProducto" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Precio">
            <h5 id="alertPrecio"></h5>
            <textarea id="descripcionProducto" name="descripcionProducto" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Descripción">
            </textarea><h5 id="alertDescripcion"></h5>
            <!--Se coloca un select para que se seleccione la categoria del producto -->
            <select id="categoriaProducto" name="categoriaProducto">
              <option value="cate" disabled selected>Categoria</option>
              <?php
              /**
              * Consulta a la base de datos tabla categoria
              * 
              * Se realiza la consulta '$query' a la tabla categoria para que muestre toda la información
              * de las categorias existentes
              */
              $query = mysqli_query($conexion, "SELECT * FROM tbl_categoria");

              /**
					     * Mientras hayan resultados de esa consulta, se muestran las categorias
               * encontradas en la consulta $query y almacenados en $row
               */
              while ($row = mysqli_fetch_array($query)) {
              ?>
                <!-- Se imprime el nombre de las categorias, realizando el llamado a $row que es quién 
							    almacena la información de la consulta $query
                -->
                <option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_categoria']; ?></option>
              <?php
              /**
               * Se cierra el ciclo de la consulta de la tabla categoria
               */
              }
              ?>
            </select>
            <h5 id="alertCategoria"></h5>
            <!--Se coloca el input submit para que se envie el formulario-->
            <input type="submit" name="submit" value="Agregar producto">
          </form>
        </div>

        <!--Se crean varios div para mostrar por botones las categorias que hay, cada una con una
          imagen relacionada a la categoria 
        -->
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
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del administrador lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>