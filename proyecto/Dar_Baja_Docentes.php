<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Docente</title>
    <link rel="stylesheet" href="css/BD.css">
    <link rel="stylesheet" href="css/Botones.css">
    <link rel="stylesheet" href="css/Formulario.css">
</head>
<body>
    <h1>Eliminar Docente</h1>
    <div class="form-container">
        <form action="" method="post">
            <div class="form-row">
                <label for="dni_eliminar">DNI del Docente a Eliminar:</label>
                <input type="text" name="dni_eliminar" required>
            </div>
            <button type="submit" name="action" value="search">Buscar Docente</button>
        </form>
    </div>
    <br>
    <br>
    <?php
    $conexion = mysqli_connect("localhost", "root", "", "classrunkbd");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_errno());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action']) && $_POST['action'] == 'search') {
            $dni_eliminar = mysqli_real_escape_string($conexion, $_POST['dni_eliminar']);

            if (!empty($dni_eliminar)) {
                $consulta = "SELECT Nombre, Apellido FROM docentes WHERE DNI='$dni_eliminar'";
                $resultado = mysqli_query($conexion, $consulta);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $docente = mysqli_fetch_assoc($resultado);
                    echo "<p>Docente encontrado: " . htmlspecialchars($docente['Nombre']) . " " . htmlspecialchars($docente['Apellido']) . "</p>";
                    echo "<form action='' method='post'>
                            <input type='hidden' name='dni_eliminar' value='$dni_eliminar'>
                            <p>¿Estás seguro de que deseas eliminar a este docente?</p>
                            <button type='submit' name='action' value='delete'>Confirmar Eliminación</button>
                          </form>";
                } else {
                    echo "No se encontró un docente con ese DNI.";
                }
            } else {
                echo "Por favor, ingresa un DNI válido.";
            }
        } elseif (isset($_POST['action']) && $_POST['action'] == 'delete') {
            $dni_eliminar = mysqli_real_escape_string($conexion, $_POST['dni_eliminar']);

            $consulta = "DELETE FROM docentes WHERE DNI='$dni_eliminar'";
            
            if (mysqli_query($conexion, $consulta)) {
                if (mysqli_affected_rows($conexion) > 0) {
                    echo "Docente eliminado correctamente.";
                } else {
                    echo "No se encontró un docente con ese DNI.";
                }
            } else {
                echo "Error: " . mysqli_error($conexion);
            }
        }
    }

    mysqli_close($conexion);
    ?>
    <br>
    <br>
    <footer>
        <a href="Boton_BDDocentes.php"><button>Volver</button></a><br>
        <a href="salir.php">Cerrar sesión</a>
    </footer>
</body>
</html>