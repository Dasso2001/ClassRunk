<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classrunk</title>
    <link rel="stylesheet" href="css/estlo.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="images/Logo_Negro.png" alt="Logo" class="logo">
            <!-- Formulario de inicio sesión -->
            <form action="inicio_sesion.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Ingresar</button>
            </form>

            <!-- Mostrar mensaje de error si los datos son incorrectos -->
            <?php
            if (isset($_GET['error'])) {
                echo "<p style='color: red;'>". htmlspecialchars($_GET['error']) ."</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>





