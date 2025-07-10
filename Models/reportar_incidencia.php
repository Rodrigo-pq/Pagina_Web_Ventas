<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databgeneral";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar mensaje
$message = "";

// Insertar datos
if (isset($_POST['guardar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $departamento = $conn->real_escape_string($_POST['departamento']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $salario = $conn->real_escape_string($_POST['salario']);
    $fecha_ingreso = $conn->real_escape_string($_POST['fecha_ingreso']);
    $estado = isset($_POST['estado']) ? 1 : 0;

    $sql = "INSERT INTO empleado (NOMBRE, APELLIDO, DEPARTAMENTO, CARGO, SALARIO, FECHA_INGRESO, ESTADO) 
            VALUES ('$nombre', '$apellido', '$departamento', '$cargo', '$salario', '$fecha_ingreso', $estado)";

    if ($conn->query($sql) === TRUE) {
        $message = "Registro guardado con éxito.";
    } else {
        $message = "Error al guardar: " . $conn->error;
    }
}

// Eliminar datos
if (isset($_POST['eliminar'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM empleado WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        $message = "Registro eliminado con éxito.";
    } else {
        $message = "Error al eliminar: " . $conn->error;
    }
}

// Obtener datos
$sql = "SELECT * FROM empleado";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
</head>
<body>
    <h2>Gestión de Empleados</h2>

    <!-- Mostrar mensaje -->
    <?php if (!empty($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required>
        
        <label for="departamento">Departamento:</label>
        <input type="text" name="departamento" id="departamento" required>
        
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required>
        
        <label for="salario">Salario:</label>
        <input type="text" name="salario" id="salario" required>
        
        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" name="fecha_ingreso" id="fecha_ingreso" required>
        
        <label for="estado">Activo:</label>
        <input type="checkbox" name="estado" id="estado">
        
        <button type="submit" name="guardar">Guardar</button>
    </form>

    <!-- Formulario para eliminar -->
    <form method="POST">
        <label for="id">ID a eliminar:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit" name="eliminar">Eliminar</button>
    </form>

    <!-- Tabla de empleados -->
    <h3>Lista de Empleados</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th>Salario</th>
            <th>Fecha de Ingreso</th>
            <th>Estado</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php 
            $estado_mostrado = false; // Control para mostrar el estado una sola vez
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo htmlspecialchars($row['NOMBRE']); ?></td>
                    <td><?php echo htmlspecialchars($row['APELLIDO']); ?></td>
                    <td><?php echo htmlspecialchars($row['DEPARTAMENTO']); ?></td>
                    <td><?php echo htmlspecialchars($row['CARGO']); ?></td>
                    <td><?php echo htmlspecialchars($row['SALARIO']); ?></td>
                    <td><?php echo htmlspecialchars($row['FECHA_INGRESO']); ?></td>
                    <td>
                        <?php 
                        if (!$estado_mostrado): 
                            echo $row['ESTADO'] ? 'Activo' : 'Desactivo'; 
                            $estado_mostrado = true; // Evitar repetir
                        endif; 
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No hay registros disponibles.</td>
            </tr>
        <?php endif; ?>
    </table>
</body><link rel="stylesheet" href="../css/Reporte.css"> <!-- Vincula tu archivo CSS -->
</html>

<?php
// Cerrar conexión
$conn->close();
?>