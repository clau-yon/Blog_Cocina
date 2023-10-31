<?php
include "../config/database.php";
session_start();

// Comprobar si userhome.php no se ha incluido previamente
if (!function_exists('obtenerIdDelUsuario')) {
    include "userhome.php";
}

if (isset($_SESSION['username'])) {
    $showUserPanel = true;
    // Obten el ID del usuario autenticado
    $userId = obtenerIdDelUsuario($conn); 
}

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // CERRAR SESION
    session_destroy();
    header("Location: ../index.php"); 
    exit;
}

if (isset($_POST["create_post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    // LOS POST DEVUELVE ROOT COMO AUTOR VOLVER A REVISAR
    $sql = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', $userId)";
    mysqli_query($conn, $sql);
}
if (isset($_POST["create_post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    
    if ($showUserPanel && $userId !== null) {
        // Inserta el post con el ID del usuario autenticado
        //FALTA DETALLES
        $sql = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', $userId)";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "<div class='alert alert-success'>Post creado exitosamente</div>";
            header("Location: ../index.php"); // Redirige al índice
            exit;
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>No se pudo crear el post</div>";
        }
    } else {
        die("No se pudo obtener el ID del usuario o el usuario no está autenticado.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear un Post</title>
</head>
<body>
    <h1>Crear un Post</h1>
    <a href="./user_post.php">Volver</a>
    <?php
        if ($showUserPanel) {
            echo '<p>Bienvenido, ' . $_SESSION['username'] . '!</p>';
            echo '<a href="?logout=1"><i class="fa-solid fa-sign-out"></i> Cerrar Sesión</a>';
        } else {
            echo '<a href="./login.php"><i class="fa-regular fa-user"></i> Login</a>';
        }
    ?>
    <a href="../index.php">Home</a>
    <a href="./createpost.php">Crear un Post</a>
    <?php
    if ($showUserPanel) {
        echo '<a href="?logout=1"><i class="fa-solid fa-sign-out"></i> Cerrar Sesión</a>';
    } else {
        echo '<a href="./login.php"><i class="fa-regular fa-user"></i> Login</a>';
    }
    ?>
    <form action="./createpost.php" method="POST">
        <label>Titulo</label>
        <input type="text" name="title">
        <label>Contenido</label><br>
        <textarea cols="50" rows="20" name="content"></textarea><br>
        <input type="submit" name="create_post" value="POST">
    </form>
</body>
</html>
