<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'conexion.php';
    $calificacion = $_POST['calificacion'];
    $pelicula = $_POST['pelicula'];
    $usuario = $_POST['usuario'];
    // Validar y escapar los datos
    $calificacion = mysqli_real_escape_string($conn, $calificacion);
    $pelicula = mysqli_real_escape_string($conn, $pelicula);
    $usuario = mysqli_real_escape_string($conn, $usuario);

    // Construir la consulta de actualización
    $updateQuery = "UPDATE calificaciones_series SET puntuacion = $calificacion, fecha = NOW() WHERE usuario_id_per = $usuario AND audiovisual_id_per = $pelicula";

    // Ejecutar la consulta de actualización y manejar errores
    if ($conn->query($updateQuery) === TRUE) {
        // Verificar si se realizaron cambios
        if ($conn->affected_rows > 0) {
            echo "Calificación actualizada correctamente";
        } else {
            // Si no se realizaron cambios, realizar una inserción
            $insertQuery = "INSERT INTO calificaciones_series (usuario_id_per, audiovisual_id_per, puntuacion, fecha) VALUES ($usuario, $pelicula, $calificacion, NOW())";

            if ($conn->query($insertQuery) === TRUE) {
                echo "Calificación insertada correctamente";
            } else {
                echo "Error al insertar la calificación: " . $conn->error;
            }
        }
    } else {
        echo "Error al actualizar la calificación: " . $conn->error;
    }

    $avgQuery = "SELECT AVG(puntuacion) AS promedio FROM calificaciones_series WHERE audiovisual_id_per = $pelicula";
            $result = $conn->query($avgQuery);

            if ($result) {
                $row = $result->fetch_assoc();
                $promedio = $row['promedio'];

                // Actualizar el campo calificacion en la tabla peliculas con el promedio
                $updatePeliculasQuery = "UPDATE series SET calificacion = $promedio WHERE serie_id = $pelicula";
                echo $updatePeliculasQuery;
                if ($conn->query($updatePeliculasQuery) === TRUE) {
                    echo "Calificación y promedio actualizados correctamente";
                } else {
                    echo "Error al actualizar el promedio en la tabla series: " . $conn->error;
                }
            } else {
                echo "Error al calcular el promedio: " . $conn->error;
            }
    // Cerrar la conexión
    $conn->close();
}
?>

