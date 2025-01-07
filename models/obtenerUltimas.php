<?php
include 'conexion.php';

$sql = "
    (SELECT 'pelicula' as tipo, titulo, pelicula_id as id, portada, fecha_lanzamiento, calificacion FROM peliculas)
    UNION ALL
    (SELECT 'serie' as tipo, titulo, serie_id as id, portada, fecha_lanzamiento, calificacion FROM series)
    ORDER BY fecha_lanzamiento DESC LIMIT 8
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="slide">';
            echo "<a href='index.php?idp=" . $row['id'] . "'>";
        if($row['tipo'] == 'pelicula'){
            echo "<img src='./images/portadas/peliculas/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";
        }else{
            echo "<img src='./images/portadas/series/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";
        }
        echo '<p><strong>' . $row['titulo'] . '</strong></p>';
        echo '<p>' . $row['fecha_lanzamiento'] . '</p>';
        echo '<p>Calificacion: ' . $row['calificacion'] . '</p>';
        echo '</a>';
        echo '</div>';
    }
} else {
    echo 'No se encontraron películas o series.';
}
?>
