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
                <label for="modulo">Modulo:</label>
                <select name="modulo" required>
                    <option value="">Seleccione una opción</option>
                    <option value="usuario_bedelia">Bedelia</option>
                    <option value="usuario_regencia">Regencia</option>
                </select>
            </div>
        <div class="form-row">
                <label for="nombre_usuario">Usuario:</label>
                <input type="text" name="nombre_usuario" required>
            </div>
            <div class="form-row">
                <label for="contraseña">Contraseña:</label>
                <input type="text" name="contraseña" required>
            </div>
            <div class="form-row">
                <label for="dni">DNI:</label>
                <input type="text" name="dni" required>
            </div>
            <div class="form-row">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>
            </div>
            <div class="form-row">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-row">
                <label for="funcion">Funcion:</label>
                <input type="text" name="funcion" required>
            </div>
            <button type="submit">Crear Usuario</button>
        </form>
    </div>
    <br>
    <br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = mysqli_connect("localhost", "root", "", "sistema_login");
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_errno());
        }
        $modulo = isset($_POST['modulo']) ? mysqli_real_escape_string($conexion, $_POST['modulo']) : '';
        $Usuario = isset($_POST['nombre_usuario']) ? mysqli_real_escape_string($conexion, $_POST['nombre_usuario']) : ''; 
        $contraseña = isset($_POST['contraseña']) ? mysqli_real_escape_string($conexion, $_POST['contraseña']) : ''; 
        $dni = isset($_POST['dni']) ? mysqli_real_escape_string($conexion, $_POST['dni']) : '';
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : '';
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : '';
        $funcion = isset($_POST['funcion']) ? mysqli_real_escape_string($conexion, $_POST['funcion']) : '';

        if (!empty($dni) && !empty($apellido) && !empty($nombre) && !empty($Usuario) && 
            !empty($contraseña) && !empty($modulo) && !empty($funcion)) {

                if ($modulo == 'usuario_bedelia') {
                    $tabla = 'usuario_bedelia'; 
                } else if ($modulo == 'usuario_regencia') {
                    $tabla = 'usuario_regencia'; 
                } else {
                    echo "Módulo no válido.";
                    exit;
                }
        
                $consulta = "INSERT INTO $tabla (nombre_usuario, contraseña, DNI, Apellido, Nombre, funcion) 
                             VALUES ('$Usuario', '$contraseña', '$dni', '$apellido', '$nombre', '$funcion')";
        
                if (mysqli_query($conexion, $consulta)) {
                    echo "Usuario creado correctamente.";
                } else {
                    echo "Error: " . mysqli_error($conexion);
                }
            } else {
                echo "Por favor, completa todos los campos.";
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