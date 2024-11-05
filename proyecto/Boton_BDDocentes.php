<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Bedelia</title>
    <link rel="stylesheet" href="css/BD.css">
    <link rel="stylesheet" href="css/Botones.css">
    <link rel="stylesheet" href="css/iconos_BDAlumnos.css">
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
    <h1>BD Docentes</h1>
    <br>
    <br>
    <div class="actions">
    <form action="Agregar_Docentes.php" method="post">
        <button style="display: flex; justify-content: flex-end; margin: 10px; background: none; border: none; cursor: pointer; margin-right: 10px;" type="submit" class="icon-button">
            <img src="images/Agregar.png" alt="Agregar" />
        </button>
    </form>
    <form action="Modificar_Docentes.php" method="post">
        <button style="display: flex; justify-content: flex-end; margin: 10px; background: none; border: none; cursor: pointer; margin-right: 10px;" type="submit" class="icon-button">
            <img src="images/Modificar.png" alt="Modificar" />
        </button>
    </form>
    <form action="Dar_Baja_Docentes.php" method="post">
        <button style="display: flex; justify-content: flex-end; margin: 10px; background: none; border: none; cursor: pointer; margin-right: 10px;" type="submit" class="icon-button">
            <img src="images/Borrar.png" alt="Dar de Baja" />
        </button>
    </form>
</div>
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
                          d.Id_Docente as ID,
                          d.DNI as DNI,
                          d.Apellido as Apellido,
                          d.Nombre as Nombre,
                          d.Fecha_de_Nacimiento as Fecha, 
                          d.Domicilio as Domicilio,
                          d.Localidad as Localidad,
                          d.Carrera as Carrera, 
                          d.Correo_Electronico as Correo
                      FROM docentes d";

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
<a href="BotonBD.php"><button>Volver</button></a><br>
<br>
<a href="salir.php">Cerrar sesión</a>
</footer>
</html>