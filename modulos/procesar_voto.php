<?php
session_start();
include 'conexion.php'; // Asegúrate de incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario_id'])) {
        die("Debes iniciar sesión para votar.");
    }

    $id_usuario = $_SESSION['usuario_id'];
    $id_disfraz = intval($_POST['id_disfraz']); // Asegúrate de que el ID es un número entero

    // Verificar si el usuario ya ha votado por este disfraz
    $sql = "SELECT * FROM votos WHERE id_usuario = ? AND id_disfraz = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_disfraz);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si ya ha votado, mostrar un mensaje
    if ($resultado->num_rows > 0) {
        die("Ya has votado por este disfraz. No puedes votar nuevamente.");
    }

    // Si no ha votado, insertar el voto
    $sql = "INSERT INTO votos (id_usuario, id_disfraz) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_disfraz);

    if ($stmt->execute()) {
        // Actualizar el conteo de votos del disfraz
        $sql = "UPDATE disfraces SET votos = votos + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_disfraz);
        $stmt->execute();

        echo "Tu voto ha sido registrado.";
    } else {
        echo "Error al registrar tu voto: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    die("Método no permitido.");
}
?>
