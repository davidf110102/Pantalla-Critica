<html>
  <head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    
  <section class="paginaInicio" id="home">
      <div class="content">
        <div class="text">
          <h1>Bienvenido a Nuestra Comunidad</h1>
          <p>
            Comparte tus opiniones y revisa las criticas de otros amantes del cine y las series. <br> Descubre el contenido audiovisual que te gusta.</p>
        </div>
        <a href="#busqueda">EXPLORAR CONTENIDO</a>
      </div>
      
  </section>
    
  <main class="busqueda" id="busqueda">
  <br><br><br>
    <div class="banner">
        <h2>Últimas Películas y Series</h2>
        <div class="slider">
        <?php include 'models/obtenerUltimas.php'; ?>
        </div>
        <div class="nav-buttons">
            <button class="prev-button">Anterior</button>
            <button class="next-button">Siguiente</button>
        </div>
    </div>
  </main>
    

<main class="busqueda2" id="busqueda2">
    <br><br><br>
    <section class="search">
    <h2>Buscar Películas y Series</h2><br>
        <form action="" method="POST">
            <input type="text" name="terminos" placeholder="Ingrese términos de búsqueda (título, descripción, elenco)" value="<?php echo isset($_POST['terminos']) ? $_POST['terminos'] : ''; ?>">
            <select class="filtro" name="genero">
                <option value="">Seleccione Género</option>
                <option value="Aventura">Aventura</option>
                <option value="Drama">Drama</option>
                <option value="Comedia">Comedia</option>
                <option value="Misterio">Misterio</option>
                <option value="Accion">Acción</option>
                <option value="Animacion">Animación</option>
                <option value="Ciencia Ficcion">Ciencia Ficción</option>
                <option value="Crimen">Crimen</option>
                <option value="Historia">Histórico</option>
                <option value="Suspenso">Suspenso</option>
                <option value="Sitcom">Sitcom</option>
                <option value="Fantasia">Fantasía</option>
                <option value="Thriller">Thriller</option>
                <option value="Satira">Sátira</option>
                <option value="Musica">Musical</option>
                <option value="Intriga">Intriga</option>
                <option value="Terror">Terror</option>
                <option value="Supernatural">Supernatural</option>
                <option value="Supervivencia">Supervivencia</option>
                <option value="Biografia">Biografica</option>
                <option value="Politica">Política</option>
            </select>
            <select class="filtro" name="anio">
                <option value=0>Seleccione Año</option>
                <option value=1950>1950 - 1959</option>
                <option value=1960>1960 - 1969</option>
                <option value=1970>1970 - 1979</option>
                <option value=1980>1980 - 1989</option>
                <option value=1990>1990 - 1999</option>
                <option value=2000>2000 - 2009</option>
                <option value=2010>2010 - 2019</option>
                <option value=2020>2020 - 2023</option>
            </select>
            <button type="submit">Buscar</button>
        </form>
    </section>
    <section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'models/busquedaseriespeliculas.php';
    }
    ?>
    </section> 
  </main>
    <main>
      <br><br>
  <h2>Estadísticas</h2>
    <h3>Cantidad de peliculas por genero</h3>
    <div id="chartContainer">
    <canvas id="myChart"></canvas>
  </div>
  <?php include 'models/graficos/obtenercantidadgenero.php'; ?>
  <h3>Cantidad de series por genero</h3>
  <div id="chartContainer">
    <canvas id="myChart2"></canvas>
  </div>
  <?php include 'models/graficos/obtenercantidadgenero2.php'; ?>
  <h3>Promedio de calificación de peliculas por genero</h3>
  <div id="chartContainer">
    <canvas id="myChart3"></canvas>
  </div>
  <?php include 'models/graficos/obtenerpromedio1.php'; ?>
  <h3>Promedio de calificación de series por genero</h3>
  <div id="chartContainer">
    <canvas id="myChart4"></canvas>
  </div>
  <?php include 'models/graficos/obtenerpromedio2.php'; ?>
  </main>


  <script src="js/script.js"></script>
  </body>
</html>
