<?php
// Conexión a la base de datos
$servidor = 'localhost';
$usuario = 'root'; // Cambia esto según tu configuración de MySQL
$contraseña = '';  // Cambia esto si tienes una contraseña configurada en MySQL
$base_de_datos = 'databgeneral';

// Conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificación de la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Guardar nuevo cliente
if (isset($_POST['guardar'])) {
    $cliente = $_POST['cliente'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $importe = $_POST['importe'];

    $sql = "INSERT INTO cliente (CLIENTE, DNI, TELEFONO, ID_PRODUCTO, PRECIO, CANTIDAD, IMPORTE) 
            VALUES ('$cliente', '$dni', '$telefono', '$id_producto', '$precio', '$cantidad', '$importe')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p>Cliente registrado correctamente</p>";
    } else {
        $mensaje = "<p>Error: " . $conexion->error . "</p>";
    }
}

// Eliminar cliente
if (isset($_POST['eliminar'])) {
    $cliente_id = $_POST['cliente_id'];
    $sql = "DELETE FROM cliente WHERE ID_CLIENTE = '$cliente_id'";  // Cambié 'cliente_id' por 'ID_CLIENTE'

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p>Cliente eliminado correctamente</p>";
    } else {
        $mensaje = "<p>Error: " . $conexion->error . "</p>";
    }
}

// Actualizar cliente (si se pasa un id y los nuevos datos)
if (isset($_GET['actualizar'])) {
    $cliente_id = $_GET['cliente_id'];
    $cliente = $_GET['cliente'];
    $dni = $_GET['dni'];
    $telefono = $_GET['telefono'];
    $id_producto = $_GET['id_producto'];
    $precio = $_GET['precio'];
    $cantidad = $_GET['cantidad'];
    $importe = $_GET['importe'];

    $sql = "UPDATE cliente SET CLIENTE='$cliente', DNI='$dni', TELEFONO='$telefono', ID_PRODUCTO='$id_producto', 
            PRECIO='$precio', CANTIDAD='$cantidad', IMPORTE='$importe' WHERE ID_CLIENTE = '$cliente_id'";  // Cambié 'cliente_id' por 'ID_CLIENTE'

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p>Cliente actualizado correctamente</p>";
    } else {
        $mensaje = "<p>Error: " . $conexion->error . "</p>";
    }
}
$conexion->close(); // Cierra la conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
</head>
<body>

    <h2>Registrar Cliente</h2>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (isset($mensaje)) { ?>
        <div class="message"><?php echo $mensaje; ?></div>
    <?php } ?>

    <!-- Formulario para registrar un cliente -->
    <div class="form-container">
        <form action="" method="POST">
            <label for="cliente">Nombre del Cliente</label>
            <input type="text" name="cliente" id="cliente" placeholder="Nombre del Cliente" required><br>
            
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" placeholder="DNI" required><br>
            
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required><br>
            
            <label for="id_producto">ID del Producto</label>
            <input type="text" name="id_producto" id="id_producto" placeholder="ID del Producto" required><br>
            
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio" required><br>
            
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" required><br>
            
            <label for="importe">Importe</label>
            <input type="number" name="importe" id="importe" placeholder="Importe" required><br>

            <button type="submit" name="guardar">Guardar Cliente</button>
        </form>
    </div>

    <!-- Cuadro para mostrar la información ingresada -->
    <?php if (isset($cliente) && isset($dni) && isset($telefono) && isset($id_producto)) { ?>
        <div class="info-container">
            <h3>Información del Cliente Registrado</h3>
            <p><strong>Nombre:</strong> <?php echo $cliente; ?></p>
            <p><strong>DNI:</strong> <?php echo $dni; ?></p>
            <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
            <p><strong>ID del Producto:</strong> <?php echo $id_producto; ?></p>
            <p><strong>Precio:</strong> <?php echo $precio; ?></p>
            <p><strong>Cantidad:</strong> <?php echo $cantidad; ?></p>
            <p><strong>Importe:</strong> <?php echo $importe; ?></p>

            <!-- Botón de actualización -->
            <a class="update-link" href="?actualizar=true&cliente_id=1&cliente=NuevoCliente&dni=12345678&telefono=987654321&id_producto=101&precio=50&cantidad=3&importe=150">Actualizar Información</a>
        </div>
    <?php } ?>
</body> <div style="margin-top: 20px; text-align: center;">
<a href="PMENU.php" class="nav-button" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Regresar</a>
</html><link rel="stylesheet" href="../css/ventas.css"> <!-- Vincula tu archivo CSS -->
