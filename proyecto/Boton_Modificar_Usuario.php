<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="css/BD.css">
    <link rel="stylesheet" href="css/Botones.css">
    <link rel="stylesheet" href="css/Formulario_Modificar.css">
</head>
<body>
    <h1>Modificar Usuario</h1>
    <div class="form-container">
        <form action="" method="post">
            <div class="form-row">
                <label for="dni">DNI del Usuario:</label>
                <input type="text" name="dni" required>
            </div>
            <button type="submit" name="action" value="search">Buscar Usuario</button>
        </form>
    </div>

    <?php
$conexion = mysqli_connect("localhost", "root", "", "sistema_login");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_errno());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'search') {
        $dni = mysqli_real_escape_string($conexion, $_POST['dni']);

        if (!empty($dni)) {
            $consulta_bedelia = "SELECT * FROM usuario_bedelia WHERE DNI='$dni'";
            $consulta_regencia = "SELECT * FROM usuario_regencia WHERE DNI='$dni'";
            $resultado_bedelia = mysqli_query($conexion, $consulta_bedelia);
            $resultado_regencia = mysqli_query($conexion, $consulta_regencia);

            if ($resultado_bedelia && mysqli_num_rows($resultado_bedelia) > 0) {
                $usuario = mysqli_fetch_assoc($resultado_bedelia);
                $tabla = "usuario_bedelia"; 

            } elseif ($resultado_regencia && mysqli_num_rows($resultado_regencia) > 0) {
                $usuario = mysqli_fetch_assoc($resultado_regencia);
                $tabla = "usuario_regencia"; 

            } else {
                echo "<p>No se encontró un usuario con ese DNI.</p>";
            }

            if (isset($usuario)) {
                echo "<div class='form-container'>
                        <form action='' method='post'>
                            <input type='hidden' name='dni' value='" . htmlspecialchars($usuario['DNI']) . "'>
                            <div class='form-row'>
                                <label for='nombre_usuario'>Usuario:</label>
                                <input type='text' name='nombre_usuario' value='" . htmlspecialchars($usuario['nombre_usuario']) . "' required>
                            </div>
                            <div class='form-row'>
                                <label for='contraseña'>Contraseña:</label>
                                <input type='text' name='contraseña' value='" . htmlspecialchars($usuario['contraseña']) . "' required>
                            </div>
                            <div class='form-row'>
                                <label for='nombre'>Nombre:</label>
                                <input type='text' name='nombre' value='" . htmlspecialchars($usuario['Nombre']) . "' required>
                            </div>
                            <div class='form-row'>
                                <label for='apellido'>Apellido:</label>
                                <input type='text' name='apellido' value='" . htmlspecialchars($usuario['Apellido']) . "' required>
                            </div>
                            <div class='form-row'>
                                <label for='funcion'>Función:</label>
                                <input type='text' name='funcion' value='" . htmlspecialchars($usuario['Funcion']) . "' required>
                            </div>
                            <input type='hidden' name='tabla' value='" . htmlspecialchars($tabla) . "'>
                            <button type='submit' name='action' value='update'>Modificar Usuario</button>
                        </form>
                      </div>";
            }
        } else {
            echo "<p>Por favor, ingresa un DNI válido.</p>";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
        $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
        $nombre_usuario = mysqli_real_escape_string($conexion, $_POST['nombre_usuario']);
        $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
        $funcion = mysqli_real_escape_string($conexion, $_POST['funcion']);
        $tabla = mysqli_real_escape_string($conexion, $_POST['tabla']); 

        $updateConsulta = "UPDATE $tabla SET 
                            nombre_usuario='$nombre_usuario', 
                            contraseña='$contraseña', 
                            Nombre='$nombre', 
                            Apellido='$apellido', 
                            Funcion='$funcion' 
                           WHERE DNI='$dni'";

        if (mysqli_query($conexion, $updateConsulta)) {
            if (mysqli_affected_rows($conexion) > 0) {
                echo "<p>Datos del usuario modificados correctamente.</p>";
            } else {
                echo "<p>No se encontraron cambios para realizar.</p>";
            }
        } else {
            echo "<p>Error: " . mysqli_error($conexion) . "</p>";
        }
    }
}


mysqli_close($conexion);
?>

    <footer>
        <a href="Boton_Reg_Usuarios.php"><button>Volver</button></a><br>
        <a href="salir.php">Cerrar sesión</a>
    </footer>
</body>
</html>