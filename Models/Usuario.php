<?php
// Definir un único usuario con roles y contraseñas ficticias
$usuarios = [
    'usuario_ficticio' => [
        'email' => 'usuario@gmail.com',
        'password' => '123456', // Contraseña predefinida
        'role' => 'Cliente' // Puede ser Cliente, Proveedor, Administrador
    ],
    'proveedor_ficticio' => [
        'email' => 'proveedor@gmail.com',
        'password' => '123456',
        'role' => 'Proveedor'
    ],
    'admin_ficticio' => [
        'email' => 'admin@gmail.com',
        'password' => '123456',
        'role' => 'Administrador'
    ]
];

// Verificar si el formulario ha sido enviado 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si las credenciales son correctas
    $usuario_valido = false;
    foreach ($usuarios as $usuario) {
        if ($email == $usuario['email'] && $password == $usuario['password']) {
            $usuario_valido = true;
            echo "Bienvenido, " . $email . "! Has iniciado sesión como " . $usuario['role'] . ".<br>";
            echo "Acceso concedido a las opciones de " . $usuario['role'] . ".";
            break;
        }
    }

    // Si las credenciales no coinciden
    if (!$usuario_valido) {
        echo "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../css/login.css"> <!-- Vincula tu archivo CSS -->
</head>
<body>

<!-- Formulario de inicio de sesión -->
<div class="login-container">
    <form action="login.php" method="POST" class="login-form">
        <img src="../img/USUARIO.png" alt="Usuario" class="usuario-img"> <!-- Ruta correcta para la imagen -->
        <h2>Iniciar sesión</h2>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Contraseña:</label>
        <div class="password-container">
            <input type="password" name="password" id="password" required><br>
            <button type="button" onclick="togglePassword()">Mostrar/ocultar</button>
        </div>

        <button type="submit">Iniciar sesión</button>
    </form>

    <!-- Mostrar los datos de usuario predefinidos -->
    <div class="user-info">
        <h3>Datos de los usuarios predefinidos</h3>
        <ul>
            <?php foreach ($usuarios as $key => $usuario): ?>
                <li><strong><?php echo ucfirst(str_replace('_ficticio', '', $key)); ?>:</strong> <?php echo $usuario['email']; ?> | Rol: <?php echo $usuario['role']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    // Función para mostrar u ocultar la contraseña
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
    }
</script>

</body>
</html>