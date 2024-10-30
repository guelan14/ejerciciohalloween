<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concurso de disfraces de Halloween</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <nav>
    <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php">Ver Disfraces</a></li>
            <li><a href="index.php?modulo=procesar_registro">Registro</a></li>
            <li><a href="index.php?modulo=procesar_login">Iniciar Sesión</a></li>
            <li><a href="index.php?modulo=procesar_disfraz">Panel de Administración</a></li>
        </ul>
    </nav>
    <header>
        <h1>Concurso de disfraces de Halloween</h1>
    </header>
    <main>
        <?php
    // Obtener el módulo desde la URL, si no existe usa 'ver_disfraces'
    $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'ver_disfraces';

    // Cargar los archivos según el valor del parámetro 'modulo'
    switch ($modulo) {
        case 'procesar_registro':
            include 'modulos/procesar_registro.php';
            break;

        case 'procesar_login':
            include 'modulos/procesar_login.php';
            break;

        case 'procesar_disfraz':
            include 'modulos/procesar_disfraz.php';
            break;

        default:
            include 'modulos/ver_disfraces.php';
            break;
    }
    ?>        
       
    </main>
    <script src="js/script.js"></script>
</body>
</html>
