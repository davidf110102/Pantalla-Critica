<?php
        include 'conexion.php';

        if (isset($_GET['idp'])) {
            $id_serie = $_GET['idp'];
            $usuario_id = $_SESSION["usuario_id"];


            $sql = "SELECT * FROM series WHERE serie_id = $id_serie";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            
                echo "<div class='multimedia'>";
                echo "<h2>" . $row['titulo'] . "</h2>";
                echo "<p><strong>Calificación:</strong> <span class='rating'>" . number_format($row['calificacion'], 1) . "/10"."</span></p>";
                echo "</div>";
                echo "<br>";
                echo "<div class='multimedia'>";
                echo "<img class='peliimg'src='./images/portadas/series/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";
                if($row['trailer']==''){
                    $youtube_video_id = "4u87tmlj4oE&t=1s";
                }else{
                    $youtube_video_id = $row['trailer'];
                }
                echo "<iframe width='760' height='435' src='https://www.youtube.com/embed/$youtube_video_id' frameborder='0' allowfullscreen></iframe>";
                echo "</div>";
                echo "<br>";
                echo "<p class='info'><strong>Creador:</strong> " . $row['creador'] . "</p>";
                echo "<p class='info'><strong>Capitulos:</strong> " . $row['capitulos'] . "</p>";
                echo "<p class='info'><strong>Clasificación:</strong> " . $row['clasificacion'] . "</p>";
                echo "<p class='info'><strong>Fecha de Lanzamiento:</strong> " . $row['fecha_lanzamiento'] . "</p>";
                echo "<p class='info'><strong>Fecha de Finalizacion:</strong> " . $row['fecha_finalizacion'] . "</p>";
                echo "<p class='info'><strong>Género:</strong> " . $row['genero'] . "</p>";
                echo "<p class='description'><strong>Sinopsis:</strong> " . $row['sinopsis'] . "</p>";
                $sql_actores = "SELECT actores.actor_id, actores.nombre, actores.foto FROM actores
                        INNER JOIN actores_series ON actores.actor_id = actores_series.actor_id_per
                        WHERE actores_series.serie_id_per = $id_serie";

        $result_actores = $conn->query($sql_actores);

        if ($result_actores->num_rows > 0) {
            echo "<h3>Reparto Principal:</h3>";
            echo "<div class='actores'>";
            while ($row_actores = $result_actores->fetch_assoc()) {
                echo "<div class='actor'>";
                echo "<a href='index.php?ida=" . $row_actores['actor_id'] . "'>";
                $rutaImagen = './images/portadas/actores/' . $row_actores['foto'];
                if (file_exists($rutaImagen)) {
                    echo "<img src='$rutaImagen' alt='" . $row_actores['nombre'] . "'>";
                } else {
                    echo "<img src='./images/portadas/actores/avatar.jpg' alt='pep'>";
                }
                echo "<p>" . $row_actores['nombre'] . "</p>";
                echo "</a>";
                echo "</div>";

            }
            echo "</div>";
        } else {
            echo "No se encontraron actores para esta serie.";
        }

            } else {
                echo "No se encontró ninguna serie con ese ID.";
            }

echo "<h3>Reseñas de Usuarios:</h3>";
            $sql = "SELECT r.resenia_id, r.resenia_id_padre, u.usuario_id, u.nombre, u.foto, r.texto, r.fecha, r.cant_util, r.cant_no_util, c.puntuacion
        FROM resenias_series r
        INNER JOIN usuarios u ON r.usuario_id_per = u.usuario_id
        LEFT JOIN calificaciones_series c ON r.usuario_id_per = c.usuario_id_per AND r.audiovisual_id_per = c.audiovisual_id_per
        WHERE r.audiovisual_id_per = $id_serie AND r.resenia_id_padre = 0";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados
    while ($row = $result->fetch_assoc()) {
        echo "<div id='resenias_usuarios'>";
        echo "<div class='multimedia'>";  
        echo "<a class = 'multimedia2' href='index.php?idu=" . $row['usuario_id'] . "'>";       
        $rutaImagen = './images/portadas/usuarios/' . $row['foto'];
            if (file_exists($rutaImagen)) {
                echo "<img class='usuarioimg2' src='$rutaImagen' alt='" . $row['nombre'] . "'>";
            } else {
                echo "<img class='usuarioimg2' src='./images/portadas/usuarios/usuariohombre.jpg' alt='pep'>";
            }
        echo "<div>";
        echo "<h3>" . $row["nombre"] . "</h3>";
        echo "<p class = 'fecha'>" . $row["fecha"] . "</p>";
        echo "</div>";
        echo "</a>";
        echo "Calificación: " . ($row["puntuacion"] ?? "No calificado") . "<br>"; 
        echo "</div>";
        echo "<p>" . $row["texto"] . "</p>";   
        echo "<div class='multimedia'>";      
        echo "<p><strong>Marcado como Útil: </strong><span id='c_util_" . $row["resenia_id"] . "'> " . $row["cant_util"] . "</span></p>";
        echo "<p><strong>Marcado como No Útil: </strong><span  id='c_no_util_" . $row["resenia_id"] . "'> " . $row["cant_no_util"] . "</span></p>";
        echo "<p></p>";
        echo "<p><br></p>";
        echo "</div>";
        $tipo = 'serie';
        echo "<button class='util' id='btnUtil" . $row["resenia_id"] . "' onclick='marcarComoUtil(" . $row["resenia_id"] . ', '. $row["cant_util"]. ", \"$tipo\")'>Marcar como Útil</button>";        
        echo "<button class='util' id='btnNoUtil" . $row["resenia_id"] . "' onclick='marcarComoNoUtil(" . $row["resenia_id"] . ', '. $row["cant_no_util"]. ", \"$tipo\")'>Marcar como No Útil</button>";
        echo "<button onclick='mostrarCuadroComentario(" . $row["resenia_id"] . ")'>Comentar</button>";
        echo "<div id='cuadroComentario" . $row["resenia_id"] . "' style='display: none;'>";
        echo "<br>";
        echo "<form action='' method='POST' id='resenia_form' class='formulario-resenia'>";
        echo "<input type='hidden' name='reseniapadre' value='" . $row["resenia_id"] . "'>";
        echo "<textarea name='resenia_texto' id='textoComentario" . $row["resenia_id"] . "'class='textoComentario' placeholder='Escribe tu comentario aquí...' rows='4'></textarea>";
        echo "<input type='submit' value='Enviar Comentario'>";
        echo "</form>";
        echo "</div>";
        $idpadre = $row["resenia_id"];
        $sqlhijas = "SELECT r.resenia_id, r.resenia_id_padre, u.usuario_id, u.nombre, u.foto, r.texto, r.fecha, r.cant_util, r.cant_no_util, c.puntuacion
        FROM resenias_series r
        INNER JOIN usuarios u ON r.usuario_id_per = u.usuario_id
        LEFT JOIN calificaciones_series c ON r.usuario_id_per = c.usuario_id_per AND r.audiovisual_id_per = c.audiovisual_id_per
        WHERE r.audiovisual_id_per = $id_serie AND r.resenia_id_padre = $idpadre";
        $result_hijas = $conn->query($sqlhijas);
        if ($result_hijas->num_rows > 0) {
            while ($row_hijas = $result_hijas->fetch_assoc()) {
                echo "<div id='resenias_usuarios'>";
                echo "<div class='multimedia'>";  
                echo "<a class = 'multimedia2' href='index.php?idu=" . $row_hijas['usuario_id'] . "'>";       
                    $rutaImagen = './images/portadas/usuarios/' . $row_hijas['foto'];
                 if (file_exists($rutaImagen)) {
                echo "<img class='usuarioimg2' src='$rutaImagen' alt='" . $row_hijas['nombre'] . "'>";
                 } else {
                echo "<img class='usuarioimg2' src='./images/portadas/usuarios/usuariohombre.jpg' alt='pep'>";
                }
                echo "<div>";
                 echo "<h3>" . $row_hijas["nombre"] . "</h3>";
                echo "<p class = 'fecha'>" . $row_hijas["fecha"] . "</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
                echo "<p>" . $row_hijas["texto"] . "</p>"; 
               echo "</div>";
            }
        }

        echo "</div>";
    }            
            } else {
                echo "No hay reseñas disponibles.";
            }
           
        
echo "<br>";
echo "<h3>Comparte tu Opinion</h3>";
echo "<br>";
echo "<div class='multimedia'>";
echo "    <div class='multimedia2'>";
echo "        <button id='miBoton1' onclick='abrirPantallaFlotante(1, $id_serie, $usuario_id)'>Calificar</button>";


$sql = "SELECT c.puntuacion
FROM calificaciones_series c
WHERE c.audiovisual_id_per = $id_serie AND c.usuario_id_per = $usuario_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $calificacion = $row["puntuacion"];
    echo "<span id='cEstrellas1'>$calificacion &#9733;</span>";
} else {
    echo "<span id='cEstrellas1'></span>";
}
echo "    </div>";
echo "    <div class='multimedia2'>";
echo "        <p class='adfav'>Añadir a Favoritos</p>";
                $tipo='serie';

        $sql="SELECT usuario_id_per, audiovisual_id_per
        FROM favoritos_series WHERE audiovisual_id_per = $id_serie AND usuario_id_per = $usuario_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<button class='corazonfav' id='corazon1' onclick='cambiarColor(this, \"$id_serie\", \"$usuario_id\", \"$tipo\")'><i class='fas fa-heart'></i></button>";
        } else {
            echo "<button class='corazon' id='corazon1' onclick='cambiarColor(this, \"$id_serie\", \"$usuario_id\", \"$tipo\")'><i class='fas fa-heart'></i></button>";
        }
echo "    </div>";
echo "</div>";
echo "<div id='pantallaFlotante1'>";
echo "    <div id='estrellas1' onmouseover='aplicarHoverAnteriores(event, 1)' onclick='calificar(event, 1)'>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "        <span class='estrella'>&#9733;</span>";
echo "    </div>";
echo "</div>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'models/insertarreseniaserie.php';
}
echo "<form action='' method='POST' id='resenia_form' class='formulario-resenia'>";
echo "<input type='hidden' name='reseniapadre' value='0'>";
echo "    <textarea name='resenia_texto' id='resenia_texto' placeholder='Escribe tu reseña aquí...' rows='5'></textarea>";
echo "    <input type='submit' value='Añadir Reseña'>";
echo "</form>";
        } else {
            echo "No se proporcionó un ID de serie válido en la URL.";
        }
        ?>