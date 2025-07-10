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

// Variables para el formulario de login y registro
$loginError = $registerError = "";
$showRegister = isset($_POST['showRegister']);

// Manejar el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $inputUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Consultar si las credenciales son correctas
    $sql = "SELECT * FROM login WHERE Usuario = '$inputUsername' AND Contraseña = '$inputPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $inputUsername; // Guardar el nombre de usuario en la sesión
        header("Location: PMENU.php");
        exit();
    } else {
        $loginError = "Usuario o contraseña incorrectos.";
    }
}

// Manejar el registro de nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $newUsername = mysqli_real_escape_string($conn, $_POST['newUsername']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);

    $checkUserSql = "SELECT * FROM login WHERE Usuario = '$newUsername'";
    $checkUserResult = $conn->query($checkUserSql);

    if ($checkUserResult->num_rows > 0) {
        $registerError = "El usuario ya existe.";
    } else {
        $sql = "INSERT INTO login (Usuario, Contraseña) VALUES ('$newUsername', '$newPassword')";

        if ($conn->query($sql) === TRUE) {
            $registerError = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
            $showRegister = false; // Ocultar la sección de registro tras registrar
        } else {
            $registerError = "Error al registrar el usuario: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTECNOLIC - Login y Registro</title>
    <link rel="stylesheet" href="../css/apps.css"> <!-- Cambiar la ruta si es necesario -->
</head>
<body>
    <div class="login-container">
        <h1>SOIPS</h1>

        <!-- Formulario combinado para Login y Registro -->
        <form id="authForm" method="POST">
            <?php if (!$showRegister): ?>
                <!-- Sección Login -->
                <div id="loginSection">
                    <h2>Iniciar sesión</h2>
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" placeholder="admin" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="admin" required>

                    <?php if (!empty($loginError)) { echo "<p style='color:red;'>$loginError</p>"; } ?>

                    <button type="submit" name="login">Iniciar sesión</button>
                </div>
            <?php else: ?>
                <!-- Sección Registro -->
                <div id="registerSection">
                    <h2>Registrar Usuario</h2>
                    <label for="newUsername">Nuevo Usuario:</label>
                    <input type="text" id="newUsername" name="newUsername" placeholder="Nuevo Usuario" required>

                    <label for="newPassword">Nueva Contraseña:</label>
                    <input type="password" id="newPassword" name="newPassword" placeholder="Nueva Contraseña" required>

                    <?php if (!empty($registerError)) { echo "<p style='color:red;'>$registerError</p>"; } ?>

                    <button type="submit" name="register">Registrar</button>
                </div>
            <?php endif; ?>
        </form>

        <!-- Botones para cambiar entre Login y Registro -->
        <div id="toggleButtons">
            <form method="POST">
                <?php if (!$showRegister): ?>
                    <button type="submit" name="showRegister">Registrar Usuario</button>
                <?php else: ?>
                    <button type="submit" name="showLogin">Iniciar sesión</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
