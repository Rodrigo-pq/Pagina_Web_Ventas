<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambiar según tu configuración
$password = ""; // Cambiar según tu configuración
$dbname = "databgeneral";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Variables para gestionar las acciones
$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$celular = isset($_POST['celular']) ? $_POST['celular'] : '';
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Guardar nuevo registro
if ($accion == 'guardar') {
    $sql = "INSERT INTO TBL_PRO (NOMBRE, CELULAR, EMPRESA, EMAIL) VALUES ('$nombre', '$celular', '$empresa', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert'>Registro guardado exitosamente.</div>";
    } else {
        echo "<div class='alert'>Error: " . $conn->error . "</div>";
    }
}

// Actualizar registro
if ($accion == 'actualizar') {
    $sql = "UPDATE TBL_PRO SET NOMBRE='$nombre', CELULAR='$celular', EMPRESA='$empresa', EMAIL='$email' WHERE ID='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert'>Registro actualizado exitosamente.</div>";
    } else {
        echo "<div class='alert'>Error: " . $conn->error . "</div>";
    }
}

// Buscar y eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($accion == 'buscar') {
        // Buscar registros
        $whereClauses = [];

        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $whereClauses[] = "NOMBRE LIKE '%$nombre%'";
        }
        if (!empty($_POST['celular'])) {
            $celular = $_POST['celular'];
            $whereClauses[] = "CELULAR LIKE '%$celular%'";
        }
        if (!empty($_POST['empresa'])) {
            $empresa = $_POST['empresa'];
            $whereClauses[] = "EMPRESA LIKE '%$empresa%'";
        }
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $whereClauses[] = "EMAIL LIKE '%$email%'";
        }

        if (count($whereClauses) > 0) {
            $sql = "SELECT * FROM TBL_PRO WHERE " . implode(" AND ", $whereClauses);
        } else {
            $sql = "SELECT * FROM TBL_PRO";
        }

        $result = $conn->query($sql);
    }

    if ($accion == 'eliminar' && !empty($id)) {
        // Eliminar solo el registro seleccionado
        $sql = "DELETE FROM TBL_PRO WHERE ID='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert'>Registro eliminado exitosamente.</div>";
        } else {
            echo "<div class='alert'>Error: " . $conn->error . "</div>";
        }
    }

    if ($accion == 'editar' && !empty($id)) {
        // Editar registro: cargar los datos en el formulario de edición
        $sql = "SELECT * FROM TBL_PRO WHERE ID='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['NOMBRE'];
            $celular = $row['CELULAR'];
            $empresa = $row['EMPRESA'];
            $email = $row['EMAIL'];
        }
    }
}

// Mostrar registros por defecto si no hay búsqueda
if (!isset($result)) {
    $sql = "SELECT * FROM TBL_PRO";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script>
        // Función de confirmación antes de eliminar
        function confirmarEliminacion() {
            return confirm('¿Estás seguro de que deseas eliminar este registro?');
        }
    </script>
</head>
<body>

    <!-- Formulario para buscar registros -->
    <div class="form-container">
        <h2>Buscar Registro</h2>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre"><br>
            <label for="celular">Celular:</label>
            <input type="text" name="celular"><br>
            <label for="empresa">Empresa:</label>
            <input type="text" name="empresa"><br>
            <label for="email">Email:</label>
            <input type="email" name="email"><br>
            <button type="submit" name="accion" value="buscar">Buscar</button>
        </form>
    </div>

    <!-- Formulario para agregar o actualizar registros -->
    <div class="form-container">
        <h2>Agregar o Actualizar Registro</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= $nombre; ?>"><br>
            <label for="celular">Celular:</label>
            <input type="text" name="celular" value="<?= $celular; ?>"><br>
            <label for="empresa">Empresa:</label>
            <input type="text" name="empresa" value="<?= $empresa; ?>"><br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $email; ?>"><br>
            <?php if ($id): ?>
                <button type="submit" name="accion" value="actualizar">Actualizar</button>
            <?php else: ?>
                <button type="submit" name="accion" value="guardar">Guardar</button>
            <?php endif; ?>
        </form>
    </div>

    <!-- Mostrar registros encontrados y opción para eliminar o editar -->
    <div class="records-container">
        <h2>Registros Encontrados</h2>
        <?php
        if (isset($result)) {
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Empresa</th>
                            <th>Email</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['ID']}</td>
                            <td>{$row['NOMBRE']}</td>
                            <td>{$row['CELULAR']}</td>
                            <td>{$row['EMPRESA']}</td>
                            <td>{$row['EMAIL']}</td>
                            <td>
                                <form method='POST' onsubmit='return confirmarEliminacion()'>
                                    <input type='hidden' name='id' value='{$row['ID']}'>
                                    <button type='submit' name='accion' value='eliminar'>Eliminar</button>
                                </form>
                            </td>
                            <td>
                                <form method='POST'>
                                    <input type='hidden' name='id' value='{$row['ID']}'>
                                    <button type='submit' name='accion' value='editar'>Editar</button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontraron registros.</p>";
            }
        }
        ?>
    </div>

    <!-- Botón de regreso al menú -->
    <a href="PMENU.php">
        <button class="regresar-btn">Regresar al Menú</button>
    </a>

</body>
<link rel="stylesheet" href="../css/proovedores.css"> <!-- Vincula tu archivo CSS -->
</html>