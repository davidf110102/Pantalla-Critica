<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $terminos = $_POST['terminos'];
    $genero = $_POST['genero'];
    $anio = $_POST['anio'];

    $sql = "SELECT DISTINCT series.* FROM series 
    INNER JOIN actores_series ON series.serie_id = actores_series.serie_id_per
    INNER JOIN actores ON actores_series.actor_id_per = actores.actor_id
    WHERE (series.titulo LIKE '%$terminos%' 
    OR series.sinopsis LIKE '%$terminos%'
    OR actores.nombre LIKE '%$terminos%')";
    if ($genero != '') {
        $sql .= " AND series.genero LIKE '%$genero%'";
    }
    if ($anio != '0') {

        $fecha_inicio = $anio . '-01-01';  
        $fecha_fin = ($anio + 9) . '-12-31';  
    
        $sql .= " AND STR_TO_DATE(series.fecha_lanzamiento, '%Y-%m-%d') BETWEEN STR_TO_DATE('$fecha_inicio', '%Y-%m-%d') AND STR_TO_DATE('$fecha_fin', '%Y-%m-%d')";
    }

    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        if ($genero != '') {
            echo "<p class=datos><strong>Genero:</strong> ". $genero. "</p>";
        }
        if ($anio != '0') {
            echo "<p class=datos><strong>Año de estreno:</strong> ".$anio. " - ".($anio+9). "</p>";
        }
        echo "<br>";
        while ($row = $result->fetch_assoc()) {
        echo "<a href='index.php?idp=" . $row['serie_id'] . "'>";
        echo "<div class='movie'>";
        echo "<img src='./images/portadas/series/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";
        echo "<div>";
        echo "<h2>" . $row['titulo'] . "</h2>";
        echo "<p>" . $row['sinopsis'] . "</p>";
        echo "<span>Calificación: " . $row['calificacion'] . "</span>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
        }
    } else {
        echo "No se encontraron series que coincidan con la búsqueda.";
    }

    $conn->close();
}
?>