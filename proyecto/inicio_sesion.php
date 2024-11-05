<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "sistema_login";

$conexion = new mysqli($host, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($query);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();
        if (password_verify($contraseña, $user['contraseña'])) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

            if ($user['tipo_usuario'] == 'regencia') {
                header("Location: Inicio_Regencia.php");
            } elseif ($user['tipo_usuario'] == 'bedelia') {
                header("Location: Inicio_Bedelia.php");
            } else {
                header("Location: inicio.php?error=Tipo de usuario no válido.");
            }
            exit();
        } else {
            header("Location: inicio.php?error=Contraseña incorrecta.");
            exit();
        }
    } else {
        header("Location: inicio.php?error=Usuario no encontrado.");
        exit();
    }
}

$conexion->close();
?>






