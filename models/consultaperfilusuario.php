<?php
include 'conexion.php';
if (isset($_GET['idu'])) {
$usuario_id = $_GET['idu'];
$sql = "SELECT * FROM usuarios where usuario_id =$usuario_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rutaImagen = './images/portadas/actores/' . $row['foto'];
        echo "<div class = 'usuarionombrefoto'>";
            if (file_exists($rutaImagen)) {
                echo "<img class='usuarioimg' src='$rutaImagen' alt='" . $row['nombre'] . "'>";
            } else {
                echo "<img class='usuarioimg' src='./images/portadas/usuarios/usuariohombre.jpg' alt='pep'>";
            }
        echo "<br>";
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "</div>";
        echo "<br>";
        $fechaNacimiento = new DateTime($row['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y; // Calcula la diferencia en años
        echo "<p class='info'><strong>Fecha de nacimiento:</strong> " . $row['fecha_nacimiento'] . " ($edad años)</p>";
        $genero;
        if($row['genero'] == 0){
            $genero = 'Hombre';
        }else{
            $genero = 'Mujer';
        }
        echo "<p class='info'><strong>Genero:</strong> " . $genero . "</p>";
                /* Favoritos */
                echo "<div class='info'>";
                echo "<h3>Favoritos</h3>";
                echo "<br>";
                $sqlfavoritos="SELECT
                serie_id AS id,
                titulo AS titulo_audiovisual,
                portada AS portada_audiovisual
            FROM
                series
            JOIN favoritos_series ON series.serie_id = favoritos_series.audiovisual_id_per
            WHERE
                favoritos_series.usuario_id_per = $usuario_id
            
            UNION
            SELECT
                pelicula_id AS id,
                titulo AS titulo_audiovisual,
                portada AS portada_audiovisual
            FROM
                peliculas
            JOIN favoritos_peliculas ON peliculas.pelicula_id = favoritos_peliculas.audiovisual_id_per
            WHERE
            favoritos_peliculas.usuario_id_per = $usuario_id";     
                $result = $conn->query($sqlfavoritos); 
                if ($result->num_rows > 0) {
                    echo "<div class='serpels'>";
                    while ($row = $result->fetch_assoc()) {
                    echo "<div class='serpel'>";
                    echo "<a href='index.php?idp=" . $row['id'] . "'>";
                    if($row['id']>5000000){
                        echo "<img src='./images/portadas/series/" . $row['portada_audiovisual'] . "' alt='" . $row['titulo_audiovisual'] . "'>";
                    }else{
                        echo "<img src='./images/portadas/peliculas/" . $row['portada_audiovisual'] . "' alt='" . $row['titulo_audiovisual'] . "'>";
            
                    }       
                    echo "<h3>" . $row['titulo_audiovisual'] . "</h3>";
                    echo "</a>";  
                    echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "No se han añadido series o peliculas a favoritos.";
                } 
                echo "</div>";
        /* Calificaciones */
        echo "<div class='info'>";
        echo "<h3>Calificaciones</h3>";
        echo "<br>";
        $sqlcalificaciones="SELECT
        serie_id AS id,
        titulo AS titulo_audiovisual,
        portada AS portada_audiovisual,
        puntuacion AS calificacion
    FROM
        series
    JOIN calificaciones_series ON series.serie_id = calificaciones_series.audiovisual_id_per
    WHERE
        calificaciones_series.usuario_id_per = $usuario_id
    
    UNION
    SELECT
        pelicula_id AS id,
        titulo AS titulo_audiovisual,
        portada AS portada_audiovisual,
        puntuacion AS calificacion
    FROM
        peliculas
    JOIN calificaciones_peliculas ON peliculas.pelicula_id = calificaciones_peliculas.audiovisual_id_per
    WHERE
    calificaciones_peliculas.usuario_id_per = $usuario_id";     
        $result = $conn->query($sqlcalificaciones); 
        if ($result->num_rows > 0) {
            echo "<div class='serpels'>";
            while ($row = $result->fetch_assoc()) {
            echo "<div class='serpel'>";
            echo "<a href='index.php?idp=" . $row['id'] . "'>";
            if($row['id']>5000000){
                echo "<img src='./images/portadas/series/" . $row['portada_audiovisual'] . "' alt='" . $row['titulo_audiovisual'] . "'>";
            }else{
                echo "<img src='./images/portadas/peliculas/" . $row['portada_audiovisual'] . "' alt='" . $row['titulo_audiovisual'] . "'>";
    
            }       
            echo "<h3>" . $row['titulo_audiovisual'] . "</h3>";
            echo "<p>Calificacion: " . $row['calificacion'] . "</p>";
            echo "</a>";  
            echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No se han calificado peliculas o series.";
        } 
        echo "</div>";
        /* Reseñas */
        echo "<h3>Reseñas</h3>";
        echo "<br>";
    $sql="SELECT
        serie_id AS id,
        titulo AS titulo_audiovisual,
        portada AS portada_audiovisual,
        texto AS texto_resenia
    FROM
        series
    JOIN resenias_series ON series.serie_id = resenias_series.audiovisual_id_per
    WHERE
        resenias_series.usuario_id_per = $usuario_id AND resenias_series.resenia_id_padre = 0
    
    UNION
    SELECT
        pelicula_id AS id,
        titulo AS titulo_audiovisual,
        portada AS portada_audiovisual,
        texto AS texto_resenia
    FROM
        peliculas
    JOIN resenias_peliculas ON peliculas.pelicula_id = resenias_peliculas.audiovisual_id_per
    WHERE
        resenias_peliculas.usuario_id_per = $usuario_id AND resenias_peliculas.resenia_id_padre = 0";     
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            echo "<a href='index.php?idp=" . $row['id'] . "'>";
            echo "<div class='movie'>";
            if($row['id']>5000000){
                echo "<img src='./images/portadas/series/" . $row['portada_audiovisual'] . "' alt='" . $row['titulo_audiovisual'] . "'>";
            }else{
                echo "<img src='./images/portadas/peliculas/" . $row['portada_audiovisual'] . "' alt='" . $row['titulo_audiovisual'] . "'>";
    
            }       
            echo "<div>";
            echo "<h3>" . $row['titulo_audiovisual'] . "</h3>";
            echo "<p>" . $row['texto_resenia'] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</a>";  
            }
        } else {
            echo "No se han reseñado peliculas o series.";
        } 
    }
} else {
    echo "No se encontro el usuario";
}
}else {
    echo "No se proporcionó un ID de usuario válido en la URL.";
}

$conn->close();
?>