<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Regencia</title>
    <link rel="stylesheet" href="css/Base.css">
    <link rel="stylesheet" href="css/Botones.css">
</head>
<body>
    <div class="navbar">
        <div class="user-info">
            <img src="images/Urquiza.jpg" alt="Logo de la institucion">
            <span><b><?php echo htmlspecialchars($_SESSION['usuario']); ?></b></span>
        </div>
        <img src="images/imgConf.png" alt="Configuración" class="settings-icon">
    </div>
    <h1>Regencia</h1>
    <br>
    <br>
    <div class="container"> 
    <a href=""><button> Avisos </button></a><br>
    <br>
    <a href=""><button> Comunicaciones </button></a><br>
    <br>
    <a href=""><button> Importante </button></a><br>
    <br>
    </div>
</body>
<footer>
<br>
<br> 
<br>
<br>
<a href="Inicio_Regencia.php"><button>Volver</button></a><br>
<br>
<br>
<br>
<a href="salir.php">Cerrar sesión</a>
</footer>
</html>