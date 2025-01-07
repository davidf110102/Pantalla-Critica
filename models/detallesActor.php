<?php
        include 'conexion.php';

        if (isset($_GET['ida'])) {
            $id_actor = $_GET['ida'];

            $sql = "SELECT * FROM actores WHERE actor_id = $id_actor";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>" . $row['nombre'] . "</h2>";
                echo "<br>";
                echo "<div class='multimedia2'>";
                $rutaImagen = './images/portadas/actores/' . $row['foto'];
                if (file_exists($rutaImagen)) {
                    echo "<img class='actorimg' src='$rutaImagen' alt='" . $row['nombre'] . "'>";
                } else {
                    echo "<img class='actorimg' src='./images/portadas/actores/avatar.jpg' alt='pep'>";
                }
                echo "<div class='datos_actor'>";
                echo "<p class='info'><strong>Fecha de nacimiento:</strong> " . $row['fecha_nacimiento'] . "</p>";
                echo "<p class='info'><strong>Lugar de nacimiento:</strong> " . $row['lugar_nacimiento'] . "</p>";
                echo "<p class='info'><strong>Altura:</strong> " . $row['altura'] . "</p>";
                $sql_series_peliculas = "SELECT sp.titulo, sp.portada, sp.idaudiov FROM (
        SELECT s.titulo, s.portada, s.serie_id as idaudiov
        FROM actores_series AS acs
        INNER JOIN series AS s ON acs.serie_id_per = s.serie_id
        WHERE acs.actor_id_per = $id_actor     
        UNION
        SELECT p.titulo, p.portada, p.pelicula_id as idaudiov
        FROM actores_peliculas AS acp
        INNER JOIN peliculas AS p ON acp.pelicula_id_per = p.pelicula_id
        WHERE acp.actor_id_per = $id_actor
    ) AS sp";


        $result_actores = $conn->query($sql_series_peliculas);

        if ($result_actores->num_rows > 0) {
            echo "<h3>Conocido/a por:</h3>";
            echo "<div class='serpels'>";
            while ($row_actores = $result_actores->fetch_assoc()) {
                echo "<div class='serpel'>";
                if($row_actores['idaudiov'] < 50000001){
                    echo "<img src='./images/portadas/peliculas/" . $row_actores['portada'] . "' alt='" . $row_actores['titulo'] . "'>";
                }else{
                    echo "<img src='./images/portadas/series/" . $row_actores['portada'] . "' alt='" . $row_actores['titulo'] . "'>";
                }
                echo "<p>" . $row_actores['titulo'] . "</p>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "No se encontraron peliculas o series para esta actor.";
        }

            } else {
                echo "No se encontró ningun actor con ese ID.";
            }
        } else {
            echo "No se proporcionó un ID de actor válido en la URL.";
        }
        ?>