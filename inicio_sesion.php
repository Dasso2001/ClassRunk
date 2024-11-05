<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sistema_login");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['password'];

    // Cambié $stmt a $query
    $query = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND password = ?");
    $query->bind_param("ss", $usuario, $contraseña);
    $query->execute();
    $resultado = $query->get_result();

    if ($resultado->num_rows > 0) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: control.php");
    } else {
        header("Location: inicio.php?error=Usuario o contraseña incorrectos.");
    }
    exit();
}

$conexion->close();
?>






