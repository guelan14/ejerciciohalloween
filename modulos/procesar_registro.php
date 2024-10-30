<?php
include 'conexion.php'; // Asegúrate de incluir la conexión a la base de datos

// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validar que el nombre de usuario y la contraseña no estén vacíos
    if (empty($username) || empty($password)) {
        die("El nombre de usuario y la contraseña son obligatorios.");
    }

    // Verificar si el nombre de usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        die("El nombre de usuario ya está en uso. Por favor elige otro.");
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, clave) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>

<section id="registro" class="section">
<h2>Registro</h2>
<form action="" method="POST"> <!-- Cambiado a acción vacía para la misma página -->
    <label for="username">Nombre de Usuario:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Registrarse</button>
</form>
</section>