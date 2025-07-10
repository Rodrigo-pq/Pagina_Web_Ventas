<?php
// Configuración de la base de datos
$servername = "localhost"; // El servidor de la base de datos
$username = "root"; // El usuario de la base de datos (por defecto es 'root' en XAMPP)
$password = ""; // La contraseña de la base de datos (por defecto es vacío en XAMPP)
$database = "databgeneral"; // El nombre de la base de datos

// Crear una nueva conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// echo "Conexión exitosa"; // Solo para verificar que la conexión fue exitosa
?>
