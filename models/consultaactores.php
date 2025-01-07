<?php
include 'conexion.php';

$sql = "SELECT * FROM actores";
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
?>