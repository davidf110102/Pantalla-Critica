<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $genero = ($_POST["genero"] === "Hombre") ? 0 : 1;
    $contrasenaEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    if ($_POST["contrasena"] === $_POST["confirmar_contrasena"]) {
        $sql = "INSERT INTO usuarios (correo, nombre, contrasena, fecha_nacimiento, genero) VALUES ('$correo','$nombre', '$contrasenaEncriptada', '$fecha_nacimiento', '$genero')";            

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Registro Exitoso";
            print_r($mensaje);
            header("Location: ../login.html");
            exit; 
        } else {
            $mensaje = "Error en el Registro: " . $e->getMessage();
            print_r($mensaje);
        }
    } else {
        echo '<script>
            alert("Las contraseñas no coinciden");
            window.location.href = "../login.html"; 
        </script>';
    }
}

$conn->close();
?>



