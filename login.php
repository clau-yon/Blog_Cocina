<!DOCTYPE html>
<html lang="en">
    <head>
          <title>Login</title>
          <link rel="stylesheet" type="text/css" href="./assets/style.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
          <script src="https://kit.fontawesome.com/6e316b87b7.js" crossorigin="anonymous"></script>
    </head>

<?php include('./components/header.php'); ?>   


    <div class="login">
        <form action="login.php" method="post">
            <div class="sections">
                <img src="./assets/images/login.png" width="20%">
            </div>
            <div class="sections">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required><br>
            </div>
            <div class="sections">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required><br>
            </div>
            <input  type="submit" value="Iniciar Sesión">
        </form>
        <p>¿No tienes una cuenta? <a href="register.php">Registrarse</a></p>
    </div>
    

</body>
</html>
