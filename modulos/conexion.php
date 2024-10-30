<?php
// Configuración de la base de datos
$host = "localhost";     // Host de la base de datos (generalmente localhost)
$usuario = "root";  // Usuario de la base de datos
$password = ""; // Contraseña del usuario
$base_datos = "halloween"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}

?>