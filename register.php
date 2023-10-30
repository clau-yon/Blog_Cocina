<?php
include './config/database.php'; // Incluye el archivo que contiene la conexión PDO a la base de datos
include './components/Auth.php'; // Incluye el archivo que contiene la clase Auth

$auth = new Auth($db); // Crea una instancia de Auth y pasa la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesa el formulario de registro
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if ($auth->registerUser($username, $password, $email)) {
        // El usuario se registró con éxito
        header('Location: login.php'); // Redirige al usuario a la página de inicio de sesión
    } else {
        // Hubo un error en el registro (por ejemplo, el nombre de usuario ya existe)
        echo "Error: El usuario ya existe o se produjo otro problema durante el registro.";
    }
}

// El formulario HTML de registro debe estar aquí
?>

<!DOCTYPE html>
<html lang="en">
    <head>
          <title>Register</title>
          <link rel="stylesheet" type="text/css" href="./assets/style.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
          <script src="https://kit.fontawesome.com/6e316b87b7.js" crossorigin="anonymous"></script>
    </head>

<?php include('./components/header.php'); ?>   
    <div class="register">
        <form action="register.php" method="post" novalidate>
            <div class="sections">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username"><br>
            </div>
            <div class="sections">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" ><br>
            </div>
            <div class="sections">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" ><br>
            </div>
            <input type="submit" value="Registrarse">
        </form>
    </div>



</body>
</html>
