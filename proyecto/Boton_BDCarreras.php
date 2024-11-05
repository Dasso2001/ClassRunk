<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Bedelia</title>
    <link rel="stylesheet" href="css/Base.css">
    <link rel="stylesheet" href="css/Botones.css">
</head>
<body>
<?php
     session_start();

     if (!isset($_SESSION['usuario'])) {
        header("Location: inicio.php");
        exit();
     }
    ?>
    <div class="navbar">
        <div class="user-info">
            <img src="images/Urquiza.jpg" alt="Logo de la institucion">
            <span><b><?php echo htmlspecialchars($_SESSION['usuario']); ?></b></span>
        </div>
        <img src="images/imgConf.png" alt="Configuración" class="settings-icon">
    </div>
    <h1>BD Carreras</h1>
    <br>
    <br>
    <br>
    <br>
    <div class="container"> 
    <a href="boton_BD_DS.php"><button> Desarrollo de Software </button></a>
    <a href="Boton_BD_AF.php"><button> Analisis Funcional </button></a>
    <a href="Boton_BD_ITI.php"><button> ITI </button></a><br>
    <br>
    <br>
    <br>
    <br>
    </div>
</body>
<footer>
<br>
<br> 
<br>
<br>
<a href="BotonBD.php"><button>Volver</button></a><br>
<br>
<br>
<br>
<a href="salir.php">Cerrar sesión</a>
</footer>
</html>