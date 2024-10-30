<?php
include 'modulos/conexion.php'; // Conexión a la base de datos

// Obtener disfraces de la base de datos
$sql = "SELECT id, nombre, descripcion, votos, foto FROM disfraces";
$resultado = $conn->query($sql);
?>


<section id="disfraces-list">
    <h1>Disfraces Disponibles</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($disfraz = $resultado->fetch_assoc()): ?>
            <div class="disfraz">
                <h2><?= htmlspecialchars($disfraz['nombre']) ?></h2>
                <p><?= htmlspecialchars($disfraz['descripcion']) ?></p>
                <img src="imagenes/<?= htmlspecialchars($disfraz['foto']) ?>" width="100%">
                <p>Votos: <?= $disfraz['votos'] ?></p>
                <form method="POST" action="modulos/procesar_voto.php"> <!-- Cambia esto a la ubicación de tu script -->
                    <input type="hidden" name="id_disfraz" value="<?= $disfraz['id'] ?>">
                    <button type="submit">Votar</button>
                 </form>     
            </div>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay disfraces disponibles.</p>
    <?php endif; ?>
</section>
