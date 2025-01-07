<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["contrasena"];

        if (password_verify($contrasena, $hashed_password)) {
            session_start();
            $_SESSION["usuario_id"] = $row["usuario_id"];
            $_SESSION["nombre"] = $row["nombre"];
            header("Location: ../index.php"); 
            exit;
        } else {
            echo "Contraseña incorrecta.  <a href='../login.html'>Volver al inicio de sesión</a>";
        }
    } else {
        echo "Correo no registrado. <a href='../login.html'>Volver al inicio de sesión</a>";
    }
}

$conn->close();
?>
