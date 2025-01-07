<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'conexion.php';
    $audiovisual = $_POST['pelicula'];
    $usuario = $_POST['usuario'];
    $tipo = $_POST['tipo'];
    $audiovisual = mysqli_real_escape_string($conn, $audiovisual);
    $usuario = mysqli_real_escape_string($conn, $usuario);
    $tipo = mysqli_real_escape_string($conn, $tipo);
    if($tipo == 'pelicula' ){
    $sqlVerificar = "SELECT COUNT(*) as count FROM favoritos_peliculas WHERE usuario_id_per = $usuario AND audiovisual_id_per = $audiovisual";
    $resultVerificar = $conn->query($sqlVerificar);
    $rowVerificar = $resultVerificar->fetch_assoc();
    if ($rowVerificar['count'] == 0) {
    $query = "INSERT INTO favoritos_peliculas (usuario_id_per, audiovisual_id_per) VALUES ($usuario, $audiovisual)";
    if ($conn->query($query) === TRUE) {
        echo "Película añadida a favoritos exitosamente";
    } else {
        echo "Error al añadir la película a favoritos: " . $conn->error;
    }
    }else{
        $eliminarQuery = "DELETE FROM favoritos_peliculas WHERE usuario_id_per = $usuario AND audiovisual_id_per = $audiovisual";
        if ($conn->query($eliminarQuery) === TRUE) {
            echo "Película eliminada de favoritos exitosamente";
        } else {
            echo "Error al eliminar la película de favoritos: " . $conn->error;
        }
    }
}else{
    $sqlVerificar = "SELECT COUNT(*) as count FROM favoritos_series WHERE usuario_id_per = $usuario AND audiovisual_id_per = $audiovisual";
    $resultVerificar = $conn->query($sqlVerificar);
    $rowVerificar = $resultVerificar->fetch_assoc();
    if ($rowVerificar['count'] == 0) {
    $query = "INSERT INTO favoritos_series (usuario_id_per, audiovisual_id_per) VALUES ($usuario, $audiovisual)";
    if ($conn->query($query) === TRUE) {
        echo "Serie añadida a favoritos exitosamente";
    } else {
        echo "Error al añadir la serie a favoritos: " . $conn->error;
    }
    }else{
        $eliminarQuery = "DELETE FROM favoritos_series WHERE usuario_id_per = $usuario AND audiovisual_id_per = $audiovisual";
        if ($conn->query($eliminarQuery) === TRUE) {
            echo "Serie eliminada de favoritos exitosamente";
        } else {
            echo "Error al eliminar la serie de favoritos: " . $conn->error;
        }
    }

}
    $conn->close();
}
?>