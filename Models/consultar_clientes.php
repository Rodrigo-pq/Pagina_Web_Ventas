<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databgeneral";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("<div class='error'>Conexión fallida: " . $conn->connect_error . "</div>");
}

// Insertar los datos si el formulario fue enviado
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = uniqid();
    $cliente = $conn->real_escape_string($_POST['cliente']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $reporte = $conn->real_escape_string($_POST['reporte']);

    $sql = "INSERT INTO tb_consulta (ID, CLIENTE, Correo_Electronico, Descripcion, Reporte) 
            VALUES ('$id', '$cliente', '$correo', '$descripcion', '$reporte')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success'>Nuevo registro insertado con éxito.</div>";
    } else {
        $message = "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Consulta</title>
    <link rel="stylesheet" href="consulta.css">
</head>
<body>
    <h2>Formulario de Consulta</h2>
    
    <!-- Mostrar mensaje de éxito o error una sola vez -->
    <?php if ($message) echo $message; ?>

    <form action="" method="POST">
        <label for="cliente">Cliente:</label>
        <input type="text" name="cliente" id="cliente" required>
        
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" id="correo" required>
        
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" required>
        
        <label for="reporte">Reporte:</label>
        <input type="text" name="reporte" id="reporte" required>
        
        <input type="submit" value="Guardar">
    </form>

    <h2>Registros de Consultas</h2>
    <?php
    // Consulta para obtener los datos
    $sql = "SELECT ID, CLIENTE, Correo_Electronico, Descripcion, Reporte FROM tb_consulta";
    $result = $conn->query($sql);

    if ($result !== FALSE && $result->num_rows > 0) { 
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Correo Electrónico</th>
                    <th>Descripción</th>
                    <th>Reporte</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["ID"]) . "</td>
                    <td>" . htmlspecialchars($row["CLIENTE"]) . "</td>
                    <td>" . htmlspecialchars($row["Correo_Electronico"]) . "</td>
                    <td>" . htmlspecialchars($row["Descripcion"]) . "</td>
                    <td>" . htmlspecialchars($row["Reporte"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>No hay registros disponibles o hubo un error en la consulta.</div>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</body>
</html><div style="margin-top: 20px; text-align: center;">
<a href="categorias.php" class="nav-button" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Regresar</a>
</div>