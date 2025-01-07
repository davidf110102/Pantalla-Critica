<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    // Obtener datos del formulario
    $textoResenia = $_POST['resenia_texto'];
    $reseniapadre = $_POST['reseniapadre'];
    $usuarioId = $usuario_id; // Suponiendo que $usuario_id está disponible en el script PHP
    $audiovisualId = $id_serie; // Suponiendo que $id_pelicula está disponible en el script PHP

    $sqlVerificar = "SELECT COUNT(*) as count FROM resenias_series WHERE usuario_id_per = $usuarioId AND audiovisual_id_per = $audiovisualId AND texto = '$textoResenia'";
    $resultVerificar = $conn->query($sqlVerificar);
    $rowVerificar = $resultVerificar->fetch_assoc();

if ($rowVerificar['count'] == 0) {
    $query = "INSERT INTO resenias_series (usuario_id_per, audiovisual_id_per, texto, fecha, resenia_id_padre) VALUES ($usuarioId, $audiovisualId, '$textoResenia', NOW(), $reseniapadre)";
    if ($conn->query($query) === TRUE) {
    } else {
        echo "Error al insertar la reseña: " . $conn->error;
    }
} else {
}

    // Cerrar la conexión
    $conn->close();
}
?>