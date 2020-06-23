<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
  <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
  <link rel="stylesheet" href="css/index.css">
  <title>Bardis</title>
</head>

<body>
  <div id="container">
    <div id="header">
      <!--Se coloca un icono de menú de hamburguesa para que al momento de poner la pestaña lo más pequeño
        salga ese icono 
      -->
      <ion-icon name="menu" id="icon-menu" onclick="menu()"></ion-icon>
      <!--Se crea el menú con el logo y los enlaces de navegación -->
      <nav>
        <img src="logo/IconoLu17.png" alt="">
        <div id="">
          <ul id="nav-menu"><br>
            <li><a href="">Inicio</a>
            </li>
            <li><a href="vistas/registro.php">Regístrate</a>
            </li>
            <li><a href="#contacto">Contáctanos</a></li>
            <li><a href="vistas/iniciar_sesion.php">Inicio de sesión</a>
          </ul>
        </div>
      </nav>
    </div><br>
    <!--Se crean varios div para dividir la información en cada uno de estos -->
    <div id="div-bardis">
      <!--Se coloca la imagen relacionada a bares y discotecas -->
      <img src="image/img-pc.jpg" alt="" id="img-pc">
      <div id="div-bar">
        <div id="text-bardis">
          <!--Nombre y descripción del sistema en un encabezado h1 y en un párrafo-->
          <h1>Bardis</h1><br>
          <p>Sistema de gestión para los procesos de pedidos y solicitud de canciones para bares y discotecas.</p>
          <!--Botón para ver más información del sistema -->
          <a href="#servicios"><button>Saber más</button></a>
        </div>
      </div>
    </div>
    <!--Se crea un div que contiene toda la información-->
    <div id="servicios">
      <!-- Se crea un div para poner el titulo en un encabezado h3-->
      <div class="div-titulo">
        <h3>Servicios</h3>
      </div>
      <div class="div-servicios">
        <!--Se crea el div de la información de los pedidos en un encabezado h3 y en un párrafo-->
        <div class="div-pedidos">
          <h3>Solicitud de pedidos</h3><br>
          <p>Nuestro sistema le permite a un mesero tomar el pedido de los productos
            que desea consumir un cliente de un establecimiento de una manera sencilla
            y comoda.</p>
          <!--Se coloca una imagen alusiva a los pedidos -->
          <img src="icons/bartender.png" alt="">
        </div>
        <!--Se crea el div de la información de las canciones en un encabezado h3 y en un párrafo -->
        <div class="div-canciones">
          <h3>Solicitud de canciones</h3><br>
          <p>Con Bardis los clientes pueden solicitar canciones en el establecimiento
            que cuente con nuestro sistema, solo deberán registrarse, iniciar sesión
            y solicitar las canciones.</p>
          <!--Se coloca una imagen alusiva a la música -->
          <img src="icons/dj.png" alt="">
        </div>
      </div>
    </div>
    <!--Se coloca un hr para que cree una división horizontal -->
    <hr id="hr-1">
    <!--Se crea un div que contiene toda la información-->
    <div id="informacion">
      <!--Se crea el div de la información de acerca de nosotros en un encabezado h3 y en un párrafo -->
      <div class="div-titulo-informacion">
        <h3>Acerca de nosotros</h3>
        <p>Proyecto formado por aprendices de Análisis y Desarrollo De Sistemas De Información del Sena.
          Como principal objetivo tenemos brindar una mayor comodidad a nuestros clientes por medio de nuestro sistema.</p>
      </div>
      <!--Se crea el div que va a contener la información de misión y visión -->
      <div class="div-objetivos">
        <!--Se crea el div de la información de la misión en un encabezado h3 y en un párrafo-->
        <div class="div-mision">
          <h3>Misión</h3>
          <p>Ayudar a nuestros clientes a gestionar y controlar los procesos de pedidos y solicitud de canciones en sus
            establecimientos por medio de nuestro software.</p>
        </div>
        <!--Se crea el div de la información de la visión en un encabezado h3 y en un párrafo -->
        <div class="div-vision">
          <h3>Visión</h3>
          <p>Ser la empresa elegida por los clientes, lo que nos permitirá ampliar la cobertura de nuestro sistema.</p>
        </div>
      </div>
    </div>
    <!--Se crea un div que contiene toda la información de contacto-->
    <div id="contacto">
      <!--Se crea un div que contiene el formulario de contacto-->
      <div class="div-contacto">
        <!--Se crea un formulario de contacto con su página de acción al momento de enviar 
            el formulario, en la carpeta php en el archivo contacto.php y se coloca el evento 
            onsubmit en el formulario para que en el momento que se envie se
            valide en el archivo validaciones.js el formulario de contacto
        -->
        <form action="php/contacto.php" method="POST" onsubmit="return validar()">
          <!--Se coloca un encabezado h2 para el titulo y un icono representativo de correo-->
          <h2>Contacto<img src="icons/email.png"></h2><br>
          <!--Se colocan los campos del formulario, donde cada uno de los 
            campos que se le solicitan al usuario tienen un encabezado h5 con un id de alerta para
            cada campo, la funcion de cada uno de esos es mostrar la alerta correspondiente 
            llegado el caso que el usuario intente enviar el formulario con algun campo vacio
            que sea obligatorio
          -->
          <h5 id="alert"></h5>
          <input type="text" id="nombres" placeholder="Nombres" name="nombres">
          <h5 id="textAlert"></h5>
          <input type="text" id="apellidos" placeholder="Apellidos" name="apellidos">
          <h5 id="textAlert2"></h5>
          <input type="email" id="correo" placeholder="Correo" name="correo">
          <h5 id="textAlert3"></h5>
          <textarea id="mensaje" id="mensaje" placeholder="Mensaje" name="mensaje"></textarea>
          <h5 id="textAlert4"></h5>
          <!--Se coloca el input submit para que se envie el formulario-->
          <input type="submit" name="submit" value="Enviar">
        </form>
      </div>
      <!--Se crea un div que contiene el mapa-->
      <div class="div-mapa">
        <!--Se trae el mapa de google-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5908545811626!2d-75.57375858573431!3d6.1854728287177965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4682f521a793a7%3A0xe62950703dbc2ae3!2sUrbanizaci%C3%B3n%20La%20Toscana!5e0!3m2!1ses!2sco!4v1568866719231!5m2!1ses!2sco" frameborder="0" style="border:0;border-radius: 5px; width: 100%; height: 489px;" allowfullscreen=""></iframe>
      </div>
    </div>
    <a href="#container"><img src="icons/arrow-up.png" id="arrow-up" /></a>
    <!--Se crea el footer-->
    <footer>
      <!--Se crea un div-->
      <div class="div-footer">
          <!--Se crea una sección que contiene un icono de telefono y un parrafo con dos numeros de celular-->
        <section>
          <ion-icon name="call"></ion-icon>
          <p>3205334902-3194758316</p>
        </section><br>
        <!--Se crea una sección que contiene un icono de mail y un parrafo con el correo eléctronico-->
        <section>
          <ion-icon name="mail"></ion-icon>
          <p>Bardistech@gmail.com</p>
        </section>
          
      </div>
      <!--Se crea un div para las redes sociales-->
      <div class="div-redes">
        <h3>Nuestras redes sociales</h3>
        <p>Siguenos para que estes pendiente de nuestras actualizaciones.</p><br>
        <!--Se colocan los iconos de las redes sociales-->
        <ion-icon name="logo-facebook" id="facebook"></ion-icon>
        <ion-icon name="logo-youtube" id="youtube"></ion-icon>
        <ion-icon name="logo-instagram" id="instagram"></ion-icon>
      </div>
      <div class="derechos">
        <h5>Todos los derechos reservados ©2020</h5>
      </div>
    </footer>
  </div>
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <script src="js/validaciones.js"></script>
  </script>
</body>

</html>