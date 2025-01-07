<html>
  <head>
  </head>
  <body>
    
  <main class="busqueda2" id="busqueda2">
    <br><br><br>
    <section class="search">
        <form action="" method="POST">
            <input type="text" name="terminos" placeholder="Ingrese el nombre del actor, pelicula o serie">
            <button type="submit">Buscar</button>
        </form>
    </section>

    <section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'models/busquedaactores.php';
    }else{
      include 'models/consultaactores.php';
    }
    ?>
    </section>  
  </main>
  <script src="js/script.js"></script>


  </body>
</html>