<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="css/BD.css">
    <link rel="stylesheet" href="css/Botones.css">
    <link rel="stylesheet" href="css/Formulario.css">
</head>
<body>
    <h1>Crear Usuario</h1>
    <br>
    <br>
    <div class="form-container">
    <form action="" method="post">
        <div class="form-row">
            <label for="modulo_eliminar">Módulo:</label>
            <select name="modulo" required>
                <option value="">Seleccione una opción</option>
                <option value="usuario_bedelia">Bedelia</option>
                <option value="usuario_regencia">Regencia</option>
            </select>
        </div>
        <div class="form-row">
            <label for="dni_eliminar">DNI:</label>
            <input type="text" name="dni_eliminar" required>
        </div>
        <button type="submit" name="action" value="search">Buscar Usuario</button>
    </form>
</div>
<br>
    <br>
    <br>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = mysqli_connect("localhost", "root", "", "sistema_login");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_errno());
    }
    
    $modulo = mysqli_real_escape_string($conexion, $_POST['modulo']);
    $dni_eliminar = mysqli_real_escape_string($conexion, $_POST['dni_eliminar']);

    if (isset($_POST['action']) && $_POST['action'] == 'search') {
        if (!empty($dni_eliminar)) {
            $consulta = "SELECT Nombre, Apellido FROM $modulo WHERE DNI='$dni_eliminar'";
            $resultado = mysqli_query($conexion, $consulta);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                $usuario = mysqli_fetch_assoc($resultado);
                echo "<p>Usuario encontrado: " . htmlspecialchars($usuario['Nombre']) . " " . htmlspecialchars($usuario['Apellido']) . "</p>";
                echo "<form action='' method='post'>
                        <input type='hidden' name='modulo' value='$modulo'>
                        <input type='hidden' name='dni_eliminar' value='$dni_eliminar'>
                        <p>¿Estás seguro de que deseas eliminar a este usuario?</p>
                        <button type='submit' name='action' value='delete'>Confirmar Eliminación</button>
                      </form>";
            } else {
                echo "No se encontró un usuario con ese DNI.";
            }
        } else {
            echo "Por favor, ingresa un DNI válido.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $consulta = "DELETE FROM $modulo WHERE DNI='$dni_eliminar'";
        
        if (mysqli_query($conexion, $consulta)) {
            if (mysqli_affected_rows($conexion) > 0) {
                echo "Usuario eliminado correctamente.";
            } else {
                echo "No se encontró un usuario con ese DNI.";
            }
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
    mysqli_close($conexion);
}
?>
    <footer>
        <br>
        <br>
        <a href="Boton_Reg_Usuarios.php"><button>Volver</button></a><br>
        <br>
        <a href="salir.php">Cerrar sesión</a>
    </footer>
</body>
</html>