<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla Critica</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  </head>
  <body>
    <header>
      <nav class="navbar">
        <h2 class="logo"><a href="index.php?action=inicio">PANTALLA CRITICA</a></h2>
        <input type="checkbox" id="menu-toggler">
        <label for="menu-toggler" id="hamburger-btn">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 18h18v-2H3v2zm0-5h18V11H3v2zm0-7v2h18V6H3z"/>
          </svg>
        </label>
        <?php
            include "navegacion.php";
        ?>
      </nav>
    </header>

    <section>
            <?php
            if (isset($_GET['ida'])) {
                include "views/modules/celebridad.php";          
            }else if (isset($_GET['idp'])) {
              $id = $_GET['idp'];
              if($id < 50000001){
                include "views/modules/pelicula.php";
              }else{
                include "views/modules/serie.php";
              }              
            }else if (isset($_GET['idu'])) {
              include "views/modules/perfilusuario.php";
            }else{
              $mvc=new MvcController();
            $mvc->enlacesPaginasController();
            }
            ?>
            
    </section>

    <footer>
      <div>
        <span>Copyright © 2023 ATodos los derechos Reservados</span>
      </div>
    </footer>

  </body>
</html>