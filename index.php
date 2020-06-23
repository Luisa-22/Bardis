<!--Hola! -->
<!DOCTYPE html>
<html lang="es" dir="ltr">

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
      <ion-icon name="menu" id="icon-menu" onclick="menu()"></ion-icon>
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
    <div id="div-bardis">
      <img src="image/img-pc.jpg" alt="" id="img-pc">
      <div id="div-bar">
        <div id="text-bardis">
          <h1>Bardis</h1><br>
          <p>Sistema de gestión para los procesos de pedidos y solicitud de canciones para bares y discotecas.</p>
          <a href="#servicios"><button>Saber más</button></a>
        </div>
      </div>
    </div>
    <div id="servicios">
      <div class="div-titulo">
        <h3>Servicios</h3>
      </div>
      <div class="div-servicios">
        <div class="div-pedidos">
          <h3>Solicitud de pedidos</h3><br>
          <p>Nuestro sistema le permite a un mesero tomar el pedido de los productos
            que desea consumir un cliente de un establecimiento de una manera sencilla
            y comoda.</p>
          <img src="icons/bartender.png" alt="">
        </div>
        <div class="div-canciones">
          <h3>Solicitud de canciones</h3><br>
          <p>Con Bardis los clientes pueden solicitar canciones en el establecimiento
            que cuente con nuestro sistema, solo deberán registrarse, iniciar sesión
            y solicitar las canciones.</p>
          <img src="icons/dj.png" alt="">
        </div>
      </div>
    </div>
    <hr id="hr-1">
    <div id="informacion">
      <div class="div-titulo-informacion">
        <h3>Acerca de nosotros</h3>
        <p>Proyecto formado por aprendices de Análisis y Desarrollo De Sistemas De Información del Sena.
          Como principal objetivo tenemos brindar una mayor comodidad a nuestros clientes por medio de nuestro sitema.</p>
      </div>
      <div class="div-objetivos">
        <div class="div-mision">
          <h3>Misión</h3>
          <p>Ayudar a nuestros clientes a gestionar y controlar los procesos de pedidos y solicitud de canciones en sus
            establecimientos por medio de nuestro software.</p>
        </div>
        <div class="div-vision">
          <h3>Visión</h3>
          <p>Ser la empresa elegida por los clientes, lo que nos permitirá ampliar la cobertura de nuestro sistema.</p>
        </div>
      </div>
    </div>
    <div id="contacto">
      <div class="div-contacto">
        <form>
          <h2>Contacto<img src="icons/email.png"></h2><br>
          <input type="text" placeholder="Nombres" name="">
          <input type="text" placeholder="Apellidos" name="">
          <input type="email" placeholder="Correo" name="">
          <textarea placeholder="Mensaje"></textarea>
          <button>Enviar</button>
        </form>
      </div>
      <div class="div-mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5908545811626!2d-75.57375858573431!3d6.1854728287177965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4682f521a793a7%3A0xe62950703dbc2ae3!2sUrbanizaci%C3%B3n%20La%20Toscana!5e0!3m2!1ses!2sco!4v1568866719231!5m2!1ses!2sco" frameborder="0" style="border:0;border-radius: 5px; width: 100%; height: 489px;" allowfullscreen=""></iframe>
      </div>
    </div>
    <a href="#container"><img src="icons/arrow-up.png" id="arrow-up" /></a>
    <footer>
      <div class="div-footer">
        <section>
          <ion-icon name="call"></ion-icon>
          <p>3205334902-3194758316</p>
        </section><br>
        <section>
          <ion-icon name="mail"></ion-icon>
          <p>Bardistech@gmail.com</p>
        </section><br>
        <center>
          <h5>Todos los derechos reservados ©2020</h5>
        </center>
      </div>
      <div class="div-redes">
        <h3>Nuestras redes sociales</h3>
        <p>Siguenos para que estes pendiente de nuestras actualizaciones.</p><br>
        <ion-icon name="logo-facebook" id="facebook"></ion-icon>
        <ion-icon name="logo-youtube" id="youtube"></ion-icon>
        <ion-icon name="logo-instagram" id="instagram"></ion-icon>
      </div>
    </footer>
  </div>
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <script type="text/javascript" src="js/index.js">

  </script>
</body>

</html>