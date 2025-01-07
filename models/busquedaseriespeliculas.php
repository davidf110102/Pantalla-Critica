<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $terminos = $_POST['terminos'];
    $genero = $_POST['genero'];
    $anio = $_POST['anio'];

    $sql = "(SELECT DISTINCT series.serie_id as id, series.titulo, series.sinopsis, series.portada, series.calificacion 
        FROM series 
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

$sql .= ")
    UNION
    (SELECT DISTINCT peliculas.pelicula_id as id, peliculas.titulo, peliculas.sinopsis, peliculas.portada, peliculas.calificacion 
        FROM peliculas 
        INNER JOIN actores_peliculas ON peliculas.pelicula_id = actores_peliculas.pelicula_id_per
        INNER JOIN actores ON actores_peliculas.actor_id_per = actores.actor_id
        WHERE (peliculas.titulo LIKE '%$terminos%' 
            OR peliculas.sinopsis LIKE '%$terminos%'
            OR actores.nombre LIKE '%$terminos%')";

if ($genero != '') {
    $sql .= " AND peliculas.genero LIKE '%$genero%'";
}

if ($anio != '0') {
    $fecha_inicio = $anio . '-01-01';  
    $fecha_fin = ($anio + 9) . '-12-31';  
    $sql .= " AND STR_TO_DATE(peliculas.fecha_lanzamiento, '%Y-%m-%d') BETWEEN STR_TO_DATE('$fecha_inicio', '%Y-%m-%d') AND STR_TO_DATE('$fecha_fin', '%Y-%m-%d')";
}

$sql .= ")";


    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) {
        echo '<script>window.location = "#busqueda2";</script>';
        if ($genero != '') {
        echo "<p class=datos><strong>Genero:</strong> ". $genero. "</p>";
        }
        if ($anio != '0') {
        echo "<p class=datos><strong>Año de estreno:</strong> ".$anio. " - ".($anio+9). "</p>";
        }
        echo "<br>";
        while ($row = $result->fetch_assoc()) {
        echo "<a href='index.php?idp=" . $row['id'] . "'>";
        echo "<div class='movie'>";
        if($row['id']>5000000){
            echo "<img src='./images/portadas/series/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";
        }else{
            echo "<img src='./images/portadas/peliculas/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";

        }       
        echo "<div>";
        echo "<h2>" . $row['titulo'] . "</h2>";
        echo "<p>" . $row['sinopsis'] . "</p>";
        echo "<span>Calificación: " . $row['calificacion'] . "</span>";
        echo "</div>";
        echo "</div>";
        echo "</a>";

        }
    } else {
        echo "No se encontraron series o peliculas que coincidan con la búsqueda.";
    }

    $conn->close();
}
?>