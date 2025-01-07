<?php
include 'conexion.php';

// Consulta para obtener las películas
$sql = "SELECT * FROM peliculas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<a href='index.php?idp=" . $row['pelicula_id'] . "'>";
        echo "<div class='movie'>";
        echo "<img src='./images/portadas/peliculas/" . $row['portada'] . "' alt='" . $row['titulo'] . "'>";
        echo "<div>";
        echo "<h2>" . $row['titulo'] . "</h2>";
        echo "<p>" . $row['sinopsis'] . "</p>";
        echo "<span>Calificación: " . $row['calificacion'] . "</span>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
    }
} else {
    echo "No se encontraron películas";
}

$conn->close();
?>

