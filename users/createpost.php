<?php
include "../config/database.php";

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_object($result)) {
            $username = $row->username;
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }
}

if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Verifica si hay una sesión de usuario activa
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $author_id = $row->id;
            }
            
            // Inserta el post en la tabla
            $insertQuery = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', $author_id)";
            
            if (mysqli_query($conn, $insertQuery)) {
                echo "Post creado correctamente.";
            } else {
                echo "Error al crear el post: " . mysqli_error($conn);
            }
        } else {
            echo "Error en la consulta de autor: " . mysqli_error($conn);
        }
    } else {
        // No hay una sesión de usuario activa, por lo que se crea un post con author_id nulo
        $insertQuery = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', null)";
        
        if (mysqli_query($conn, $insertQuery)) {
            echo "Post creado correctamente por un usuario anónimo.";
        } else {
            echo "Error al crear el post: " . mysqli_error($conn);
        }
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
    <form action="./createpost.php" method="POST">
        <label>Titulo</label>
        <input type="text" name="title">
        <label>Contenido</label><br>
        <textarea cols="50" rows="20" name="content"></textarea><br>
        <input type="submit" name="create_post" value="POST">
    </form>
</body>
</html>
