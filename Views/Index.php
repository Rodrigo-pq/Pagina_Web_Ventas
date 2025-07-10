<?php
// Iniciar sesión
session_start();

// Incluir los controladores necesarios
require_once '../Models/Login.php';    // Ruta ajustada a la estructura de tu proyecto
require_once '../Models/PMENU.php';    // Ruta ajustada
require_once '../Models/Ventas.php';   // Ruta ajustada
require_once '../Models/Articulos.php';// Ruta ajustada

// Redirigir al index.php (si lo deseas) o cargar alguna otra lógica según el flujo
header("Location: ../Index.php");  // Ruta ajustada
exit();
?>