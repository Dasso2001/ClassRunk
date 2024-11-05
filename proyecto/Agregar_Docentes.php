<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Docente</title>
    <link rel="stylesheet" href="css/BD.css">
    <link rel="stylesheet" href="css/Botones.css">
    <link rel="stylesheet" href="css/Formulario.css">
</head>
<body>
    <h1>Agregar Docente</h1>
    <br>
    <br>
    <div class="form-container">
        <form action="" method="post">
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
                <label for="domicilio">Domicilio:</label>
                <input type="text" name="domicilio" required>
            </div>
            <div class="form-row">
                <label for="localidad">Localidad:</label>
                <input type="text" name="localidad" required>
            </div>
            <div class="form-row">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" required>
            </div>
            <div class="form-row">
                <label for="carrera">Carrera:</label>
                <select name="carrera" required>
                    <option value="">Seleccione una opción</option>
                    <option value="DS">DS</option>
                    <option value="AF">AF</option>
                    <option value="ITI">ITI</option>
                </select>
            </div>
            <div class="form-row">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo" required>
            </div>
            <div class="form-row">
                <label for="sexo">Sexo:</label>
                <select name="sexo" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <button type="submit">Agregar Docente</button>
        </form>
    </div>
    <br>
    <br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = mysqli_connect("localhost", "root", "", "classrunkbd");
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_errno());
        }

        $dni = isset($_POST['dni']) ? mysqli_real_escape_string($conexion, $_POST['dni']) : '';
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : '';
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : '';
        $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']) : '';
        $domicilio = isset($_POST['domicilio']) ? mysqli_real_escape_string($conexion, $_POST['domicilio']) : '';
        $localidad = isset($_POST['localidad']) ? mysqli_real_escape_string($conexion, $_POST['localidad']) : '';
        $carrera = isset($_POST['carrera']) ? mysqli_real_escape_string($conexion, $_POST['carrera']) : '';
        $correo = isset($_POST['correo']) ? mysqli_real_escape_string($conexion, $_POST['correo']) : '';

        if (!empty($dni) && !empty($apellido) && !empty($nombre) && !empty($fecha_nacimiento) && 
            !empty($domicilio) && !empty($localidad) && !empty($carrera) && !empty($correo)) {

            $consulta = "INSERT INTO docentes (DNI, Apellido, Nombre, Fecha_de_Nacimiento, Domicilio, Localidad, Carrera, Correo_Electronico) 
                         VALUES ('$dni', '$apellido', '$nombre', '$fecha_nacimiento', '$domicilio', '$localidad', '$carrera', '$correo')";
            
            if (mysqli_query($conexion, $consulta)) {
                echo "Docente agregado correctamente.";
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
        <a href="Boton_BDDocentes.php"><button>Volver</button></a><br>
        <br>
        <a href="salir.php">Cerrar sesión</a>
    </footer>
</body>
</html>