<?php
include "../config/database.php";
session_start();

function obtenerIdDelUsuario() {
    global $conn;
    $username = $_SESSION['username'];
    $query = "SELECT id FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        die("No se pudo obtener el ID del usuario.");
    }
}

if (isset($_SESSION['username'])) {
    $showUserPanel = true;
    $userId = obtenerIdDelUsuario();
}

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header("Location: ../index.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
</head>
<body>
    <h1>Panel de Usuario</h1>
    <?php
    if ($showUserPanel) {
        echo '<p>Bienvenido, ' . $_SESSION['username'] . '!</p>';
        echo '<a href="?logout=1"><i class="fa-solid fa-sign-out"></i> Cerrar Sesión</a>';
        echo '<a href="./createpost.php">Crear un Post</a>'; // Agrega el enlace para crear un post
    } else {
        echo '<a href="./login.php"><i class="fa-regular fa-user"></i> Login</a>';
    }
    ?>
    <a href="../index.php">Home</a>
    <h2>Opciones:</h2>
    <ul>
        <li><a href="./user_post.php">Ver Posts Escritos</a></li>
    </ul>
</body>
</html>
