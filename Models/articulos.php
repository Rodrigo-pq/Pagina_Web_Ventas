<?php
// Conexión a la base de datos
$host = 'localhost';
$usuario = 'root'; 
$contrasena = ''; 
$basedatos = 'databgeneral';

$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Guardar, actualizar, eliminar y buscar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

    if ($accion == 'guardar') {
        // Guardar producto
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        // Verificar si el producto ya existe
        $sqlCheck = "SELECT * FROM tbl_productos WHERE NOMBRE = '$nombre'";
        $resultCheck = $conn->query($sqlCheck);
        if ($resultCheck->num_rows > 0) {
            echo "<div class='alert'>El producto '$nombre' ya existe.</div>";
        } else {
            $sql = "INSERT INTO tbl_productos (NOMBRE, DESCRIPCION, PRECIO, STOCK) 
                    VALUES ('$nombre', '$descripcion', '$precio', '$stock')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert'>Producto guardado exitosamente.</div>";
            } else {
                echo "<div class='alert'>Error: " . $conn->error . "</div>";
            }
        }
    } elseif ($accion == 'actualizar') {
        // Actualizar producto (solo los campos que el usuario haya enviado)
        $id = $_POST['id'];
        $actualizarCampos = [];
        
        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $actualizarCampos[] = "NOMBRE='$nombre'";
        }
        if (!empty($_POST['descripcion'])) {
            $descripcion = $_POST['descripcion'];
            $actualizarCampos[] = "DESCRIPCION='$descripcion'";
        }
        if (!empty($_POST['precio'])) {
            $precio = $_POST['precio'];
            $actualizarCampos[] = "PRECIO='$precio'";
        }
        if (!empty($_POST['stock'])) {
            $stock = $_POST['stock'];
            $actualizarCampos[] = "STOCK='$stock'";
        }
        
        // Si hay campos para actualizar
        if (count($actualizarCampos) > 0) {
            $sql = "UPDATE tbl_productos SET " . implode(", ", $actualizarCampos) . " WHERE ID='$id'";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert'>Producto actualizado exitosamente.</div>";
            } else {
                echo "<div class='alert'>Error: " . $conn->error . "</div>";
            }
        }
    } elseif ($accion == 'eliminar') {
        // Eliminar producto
        $id = $_POST['id'];
        $sql = "DELETE FROM tbl_productos WHERE ID='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert'>Producto eliminado exitosamente.</div>";
        } else {
            echo "<div class='alert'>Error: " . $conn->error . "</div>";
        }
    } elseif ($accion == 'buscar') {
        // Buscar productos, solo si el campo tiene valor
        $whereClauses = [];
        
        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $whereClauses[] = "NOMBRE LIKE '%$nombre%'";
        }
        if (!empty($_POST['descripcion'])) {
            $descripcion = $_POST['descripcion'];
            $whereClauses[] = "DESCRIPCION LIKE '%$descripcion%'";
        }
        if (!empty($_POST['precio'])) {
            $precio = $_POST['precio'];
            $whereClauses[] = "PRECIO LIKE '%$precio%'";
        }
        if (!empty($_POST['stock'])) {
            $stock = $_POST['stock'];
            $whereClauses[] = "STOCK LIKE '%$stock%'";
        }

        // Si se ingresaron campos para buscar
        if (count($whereClauses) > 0) {
            $sql = "SELECT * FROM tbl_productos WHERE " . implode(" AND ", $whereClauses);
        } else {
            // Si no se ingresaron campos, mostrar todos los productos
            $sql = "SELECT * FROM tbl_productos";
        }

        $result = $conn->query($sql);
    }
}

// Si no se está realizando una búsqueda, mostrar todos los productos
if (!isset($result)) {
    $sql = "SELECT * FROM tbl_productos";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestión de Productos</h1>
    <!-- Formulario único para guardar, actualizar, eliminar y buscar producto -->
    <div class="form-container">
        <h2>Formulario de Producto</h2>
        <form method="POST">
            <input type="hidden" name="accion" value="guardar"> <!-- Para guardar producto por defecto -->
            <label for="id">ID (solo para actualizar/eliminar):</label>
            <input type="number" name="id"><br>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre"><br> <!-- Ahora el campo nombre es opcional -->
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion"><br> <!-- Ahora el campo descripción es opcional -->
            <label for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01"><br> <!-- Ahora el campo precio es opcional -->
            <label for="stock">Stock:</label>
            <input type="number" name="stock"><br> <!-- Ahora el campo stock es opcional -->

            <!-- Botones para las acciones -->
            <button type="submit" name="accion" value="guardar">Guardar Producto</button>
            <button type="submit" name="accion" value="actualizar">Actualizar Producto</button>
            <button type="submit" name="accion" value="eliminar">Eliminar Producto</button>
            <button type="submit" name="accion" value="buscar">Buscar Producto</button>
        </form>
    </div>

    <!-- Mostrar productos -->
    <div class="product-container">
        <h2>Productos</h2>
        <?php
        if (isset($result)) {
            if ($result->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['ID']) . "</td>
                            <td>" . htmlspecialchars($row['NOMBRE']) . "</td>
                            <td>" . htmlspecialchars($row['DESCRIPCION']) . "</td>
                            <td>" . htmlspecialchars($row['PRECIO']) . "</td>
                            <td>" . htmlspecialchars($row['STOCK']) . "</td>
                            <td>
                                <!-- Formulario para cambiar producto -->
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='accion' value='actualizar'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                                    <button type='submit'>Cambiar</button>
                                </form>
                                <!-- Formulario para eliminar producto -->
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='accion' value='eliminar'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                                    <button type='submit' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\");'>Eliminar</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontraron productos.</p>";
            }
        }
        ?>
    </div><link rel="stylesheet" href="../css/articulos.css"> <!-- Cambiar la ruta si es necesario -->
    <div style="margin-top: 20px; text-align: center;">
        <a href="PMENU.php" class="nav-button" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Regresar</a>
    </div>
</html>