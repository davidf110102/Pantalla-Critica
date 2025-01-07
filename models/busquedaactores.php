<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $terminos = $_POST['terminos'];

    $sql = "SELECT DISTINCT actores.*
    FROM actores
    WHERE actores.actor_id IN (
        SELECT DISTINCT actores.actor_id
        FROM actores
        INNER JOIN actores_peliculas ON actores.actor_id = actores_peliculas.actor_id_per
        INNER JOIN peliculas ON actores_peliculas.pelicula_id_per = peliculas.pelicula_id
        WHERE peliculas.titulo LIKE '%$terminos%'
        OR actores.nombre LIKE '%$terminos%'
        UNION
        SELECT DISTINCT actores.actor_id
        FROM actores
        INNER JOIN actores_series ON actores.actor_id = actores_series.actor_id_per
        INNER JOIN series ON actores_series.serie_id_per = series.serie_id
        WHERE series.titulo LIKE '%$terminos%'
        OR actores.nombre LIKE '%$terminos%')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='celebridades'>";
    while ($row = $result->fetch_assoc()) {
        echo "<a href='index.php?ida=" . $row['actor_id'] . "'>";
        echo "<div class='celebridad'>";
        $rutaImagen = './images/portadas/actores/' . $row['foto'];
        if (file_exists($rutaImagen)) {
            echo "<img src='$rutaImagen' alt='" . $row['nombre'] . "'>";
        } else {
            echo "<img src='./images/portadas/actores/avatar.jpg' alt='pep'>";
        }
        echo "<p><strong>" . $row['nombre'] . "</strong></p>";
        $fecha_nacimiento = new DateTime($row['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        echo "<p>" . $edad->y . " años" . "</p>";    
        echo "</div>";
        echo "</a>";
    }
    echo "</div>";
} else {
    echo "No se encontraron actores";
}

$conn->close();
}
?>