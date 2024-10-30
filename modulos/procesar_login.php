<?php
session_start(); // Iniciar la sesión

include 'conexion.php'; // Asegúrate de incluir la conexión a la base de datos

// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = trim($_POST['login-username']);
    $password = trim($_POST['login-password']);

    // Validar que el nombre de usuario y la contraseña no estén vacíos
    if (empty($username) || empty($password)) {
        die("El nombre de usuario y la contraseña son obligatorios.");
    }

    // Consultar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $usuario['clave'])) {
            // Guardar información del usuario en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            echo "Inicio de sesión exitoso. Bienvenido, " . $_SESSION['usuario_nombre'] . "!";
            // Redirigir a la página principal o a otra página
            // header("Location: pagina_principal.php"); // Descomentar y ajustar según sea necesario
            exit();
        } else {
            die("Contraseña incorrecta.");
        }
    } else {
        die("El nombre de usuario no existe.");
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>

<section id="login" class="section">
    <h2>Iniciar Sesión</h2>
    <form action="" method="POST"> <!-- Cambiado a acción vacía para la misma página -->
        <label for="login-username">Nombre de Usuario:</label>
        <input type="text" id="login-username" name="login-username" required>
        
        <label for="login-password">Contraseña:</label>
        <input type="password" id="login-password" name="login-password" required>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</section>