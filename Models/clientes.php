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

// Definir variables de los campos
$id_cliente = $cliente = $dni = $telefono = $id_producto = $precio = $cantidad = $importe = "";
$mensaje = "";

// Procesar las solicitudes del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Guardar registro
    if (isset($_POST['guardar'])) {
        $id_cliente = $_POST['id_cliente'];
        $cliente = $_POST['cliente'];
        $dni = $_POST['dni'];
        $telefono = $_POST['telefono'];
        $id_producto = $_POST['id_producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $importe = $_POST['importe'];

        // Sentencia preparada para insertar el registro
        $stmt = $conn->prepare("INSERT INTO cliente (ID_CLIENTE, CLIENTE, DNI, TELEFONO, ID_PRODUCTO, PRECIO, CANTIDAD, IMPORTE) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssdds", $id_cliente, $cliente, $dni, $telefono, $id_producto, $precio, $cantidad, $importe);

        if ($stmt->execute()) {
            $mensaje = "Nuevo registro guardado correctamente";
        } else {
            $mensaje = "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Actualizar registro
    if (isset($_POST['actualizar'])) {
        $id_cliente = $_POST['id_cliente'];
        $cliente = $_POST['cliente'];
        $dni = $_POST['dni'];
        $telefono = $_POST['telefono'];
        $id_producto = $_POST['id_producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $importe = $_POST['importe'];

        // Sentencia preparada para actualizar el registro
        $stmt = $conn->prepare("UPDATE cliente SET CLIENTE=?, DNI=?, TELEFONO=?, ID_PRODUCTO=?, PRECIO=?, CANTIDAD=?, IMPORTE=? 
                                WHERE ID_CLIENTE=?");
        $stmt->bind_param("sssdsdsi", $cliente, $dni, $telefono, $id_producto, $precio, $cantidad, $importe, $id_cliente);

        if ($stmt->execute()) {
            $mensaje = "Registro actualizado correctamente";
        } else {
            $mensaje = "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Eliminar registro
    if (isset($_POST['eliminar'])) {
        $id_cliente = $_POST['id_cliente'];

        // Sentencia preparada para eliminar el registro
        $stmt = $conn->prepare("DELETE FROM cliente WHERE ID_CLIENTE=?");
        $stmt->bind_param("i", $id_cliente);

        if ($stmt->execute()) {
            $mensaje = "Registro eliminado correctamente";
        } else {
            $mensaje = "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Buscar registro
    if (isset($_POST['buscar'])) {
        $id_cliente = $_POST['id_cliente'];

        // Sentencia preparada para buscar el registro
        $stmt = $conn->prepare("SELECT * FROM cliente WHERE ID_CLIENTE=?");
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si la consulta devuelve resultados
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Asignar los valores a las variables
            $id_cliente = $row['ID_CLIENTE'];
            $cliente = $row['CLIENTE'];
            $dni = $row['DNI'];
            $telefono = $row['TELEFONO'];
            $id_producto = $row['ID_PRODUCTO'];
            $precio = $row['PRECIO'];
            $cantidad = $row['CANTIDAD'];
            $importe = $row['IMPORTE'];
        } else {
            $mensaje = "No se encontraron registros con ese ID Cliente.";
        }
        $stmt->close();
    }
}

// Mostrar todos los clientes
$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cliente y Producto</title>
    <link rel="stylesheet" href="../css/cliente.css"> <!-- Cambiar la ruta si es necesario -->
</head>
<body>
    <div class="container">
        <!-- Formulario de cliente y producto -->
        <div class="form-container">
            <h2>Formulario de Cliente y Producto</h2>
            <form action="" method="POST">
                <label for="id_cliente">ID Cliente:</label>
                <input type="text" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>" required><br>

                <label for="cliente">Cliente:</label>
                <input type="text" id="cliente" name="cliente" value="<?php echo $cliente; ?>" required><br>

                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" value="<?php echo $dni; ?>" required><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required><br>

                <label for="id_producto">ID Producto:</label>
                <input type="text" id="id_producto" name="id_producto" value="<?php echo $id_producto; ?>" required><br>

                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" value="<?php echo $precio; ?>" required><br>

                <label for="cantidad">Cantidad:</label>
                <input type="text" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>" required><br>

                <label for="importe">Importe:</label>
                <input type="text" id="importe" name="importe" value="<?php echo $importe; ?>" required><br>

                <button type="submit" name="guardar">Guardar</button>
                <button type="submit" name="actualizar">Actualizar</button>
                <button type="submit" name="eliminar">Eliminar</button>
                <button type="submit" name="buscar">Buscar</button>
            </form>

            <div class="mensaje">
                <?php if ($mensaje) { echo "<p>$mensaje</p>"; } ?>
            </div>
        </div>

        <!-- Mostrar todos los registros -->
        <div class="table-container">
            <h3>Clientes Registrados</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Cliente</th>
                        <th>Cliente</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>ID Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_CLIENTE'] . "</td>";
                            echo "<td>" . $row['CLIENTE'] . "</td>";
                            echo "<td>" . $row['DNI'] . "</td>";
                            echo "<td>" . $row['TELEFONO'] . "</td>";
                            echo "<td>" . $row['ID_PRODUCTO'] . "</td>";
                            echo "<td>" . $row['PRECIO'] . "</td>";
                            echo "<td>" . $row['CANTIDAD'] . "</td>";
                            echo "<td>" . $row['IMPORTE'] . "</td>";
                            echo "<td>
                                    <form action='' method='POST'>
                                        <input type='hidden' name='id_cliente' value='" . $row['ID_CLIENTE'] . "'>
                                        <button type='submit' name='buscar'>Editar</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No hay registros.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body> 
    </div>
</div>
</html><div style="margin-top: 20px; text-align: center;">
<a href="PMENU.php" class="nav-button" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Regresar</a>

<?php $conn->close(); ?>