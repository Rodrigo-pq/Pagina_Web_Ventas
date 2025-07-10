<?php
// Iniciar sesión
session_start();

// Activar el buffer de salida para evitar errores de encabezados
ob_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../Views/login.php"); // Redirigir a login si no está autenticado
    exit();
}

// Incluir los controladores o modelos necesarios
$basePath = dirname(__DIR__); // Obtiene la ruta base de tu proyecto
require_once "$basePath/Models/Login.php";     
require_once "$basePath/Models/PMENU.php";     
require_once "$basePath/Models/Ventas.php";    
require_once "$basePath/Models/Articulos.php"; 

// Obtener la acción desde la URL (si está presente)
$action = $_GET['action'] ?? 'index';

// Gestión de acciones con un switch estructurado
try {
    switch ($action) {
        case 'logout':
            // Cerrar sesión y redirigir a login
            session_destroy();
            header("Location: ../Views/login.php");
            exit();

        default:
            // Acción por defecto
            header("Location: ../Views/index.php");
            exit();
    }
} catch (Exception $e) {
    // Manejo de errores para depuración
    echo "Se produjo un error: " . $e->getMessage();
}

// Limpiar el buffer de salida
ob_end_flush();
?>