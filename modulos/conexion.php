<?php
function conectar()
{
// Configuración de la base de datos
$host = "localhost";     // Host de la base de datos (generalmente localhost)
$usuario = "root";  // Usuario de la base de datos
$password = ""; // Contraseña del usuario
$base_datos = "halloween"; // Nombre de la base de datos

// Crear la conexión
global $con; 
$con = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($con->connect_error) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();}
     else {
        $con -> set_charset("utf8");
        $ret=true;
    }
    function desconectar()
    {
        global $con;
        mysqli_close($con);
    }
}
?>