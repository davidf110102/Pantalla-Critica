<html>
  <head>
  </head>
  <body>
    
  <main class="busqueda" id="busqueda">
    <br><br><br>
    <section class="search">
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
            <select class="filtro"  name="anio">
                <option value=0>Seleccione Año</option>
                <option value=1980>1980 - 1989</option>
                <option value=1990>1990 - 1999</option>
                <option value=2000>2000 - 2009</option>
                <option value=2010>2010 - 2019</option>
                <option value=2020>2020 - 2023</option>
            </select>
            <button type="submit">Buscar</button>
        </form>
    </section>

    <section class="results">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'models/busquedaseries.php';
    }else{
      include 'models/consultaseries.php';
    }
    ?>
    </section>  
  </main>
  <script src="js/script.js"></script>


  </body>
</html>