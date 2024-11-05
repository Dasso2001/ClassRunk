<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Bedelia</title>
    <link rel="stylesheet" href="css/BD.css">
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
    <h1>Alumnos en la Carrera de Analisis Funcional </h1>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Fecha de Nacimiento</th>
                <th>Domicilio</th>
                <th>Localidad</th>
                <th>Carrera</th>
                <th>Correo Electronico</th>
            </tr>
        </thead>
        <tbody>
        <?php
          $conexion = mysqli_connect("localhost", "root", "", "classrunkbd");
          if (!$conexion) {
              die("No hemos podido conectarnos a la base de datos: " . mysqli_connect_errno());
          }
          $consulta = "SELECT 
                          a.Id_Alumno as ID,
                          a.DNI as DNI,
                          a.Apellido as Apellido,
                          a.Nombre as Nombre,
                          a.Fecha_de_Nacimiento as Fecha, 
                          a.Domicilio as Domicilio,
                          a.Localidad as Localidad,
                          a.Carrera as Carrera,
                          a.Correo_Electronico as Correo 
                      FROM alumnos a
                      WHERE a.Carrera = 'AF' ";

          $resultado = mysqli_query($conexion, $consulta);
          if (!$resultado) {
              die("Error en la consulta: " . mysqli_error($conexion));
          }

          while ($fila = mysqli_fetch_assoc($resultado)) {
              echo "<tr>";
              echo "<td>" . $fila['ID'] . "</td>";
              echo "<td>" . $fila['DNI'] . "</td>";
              echo "<td>" . $fila['Apellido'] . "</td>";
              echo "<td>" . $fila['Nombre'] . "</td>";
              echo "<td>" . $fila['Fecha'] . "</td>";
              echo "<td>" . $fila['Domicilio'] . "</td>";
              echo "<td>" . $fila['Localidad'] . "</td>";
              echo "<td>" . $fila['Carrera'] . "</td>";
              echo "<td>" . $fila['Correo'] . "</td>";
              echo "</tr>";
          }

          mysqli_close($conexion);
        ?>
        </tbody>
    </table>

    <footer>
        <br>
        <br>
        <a href="Boton_BDCarreras.php"><button>Volver</button></a><br>
        <br>
        <a href="salir.php">Cerrar sesión</a>
    </footer>
</body>
</html>