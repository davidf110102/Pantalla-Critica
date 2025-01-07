<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'conexion.php';
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    $tipo = $_POST['tipo'];

    // Validar y escapar los datos
    $id = mysqli_real_escape_string($conn, $id);
    $cantidad = mysqli_real_escape_string($conn, $cantidad);
    $tipo = mysqli_real_escape_string($conn, $tipo);

    if($tipo == 'pelicula' ){

    $updateQuery = "UPDATE resenias_peliculas SET cant_util = $cantidad WHERE resenia_id = $id";

    // Ejecutar la consulta de actualización y manejar errores
    if ($conn->query($updateQuery) === TRUE) {
        // Verificar si se realizaron cambios
        if ($conn->affected_rows > 0) {
            echo "Cantidad actualizada correctamente";
        } else {
        }
    } else {
        echo "Error al actualizar la cantidad util: " . $conn->error;
    }
    }else{
        $updateQuery = "UPDATE resenias_series SET cant_util = $cantidad WHERE resenia_id = $id";

    // Ejecutar la consulta de actualización y manejar errores
    if ($conn->query($updateQuery) === TRUE) {
        // Verificar si se realizaron cambios
        if ($conn->affected_rows > 0) {
            echo "Cantidad actualizada correctamente";
        } else {
        }
    } else {
        echo "Error al actualizar la cantidad util: " . $conn->error;
    }

    }

   
    // Cerrar la conexión
    $conn->close();
}
?>