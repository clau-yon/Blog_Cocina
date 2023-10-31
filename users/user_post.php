<?php
    include "../config/database.php"; // Corregir la ruta del archivo de conexión

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
    } else {
        echo "La sesión de usuario no está configurada.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ALL Post</h1>
    <hr></hr>
    <a href="./createpost.php">Crear post</a>
    <a href="./userhome.php">Panel</a>
    <?php
        $getuserpost=mysqli_query($conn, "SELECT * from posts");
        while ($row1=mysqli_fetch_array($getuserpost)) {
            ?>
            <h2>Titulo: <?php echo $row1['title'];?></h2>
            <h2>Contenido: <?php echo $row1['content'];?></h2>
            <h2>Autor: <?php echo $username;?></h2>
            <hr> </hr>
        
        
        <?php
        }
    
    
    ?>
</body>
</html>


