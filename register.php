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
<body>

<div class="register">
<?php
if (isset($_POST["submit"])) {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = array();
    if (empty($user) || empty($email) || empty($password)) {
        array_push($errors, "Todos los campos son requeridos");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email no es válido");
    }
    if (strlen($_POST["password"]) < 8 || !preg_match("/[0-9]/", $_POST["password"])){
        array_push($errors, "La contraseña debe tener al menos 8 caracteres y contener al menos un número");
    }
    require_once "./config/database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        array_push($errors,"Email ya existente");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
       
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss", $user, $email, $passwordHash);

            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>¡Registro exitoso!</div>";
            } else {
                echo "<div class='alert alert-danger'>No se pudo registrar. Inténtalo de nuevo más tarde.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error en la consulta SQL.</div>";
        }
    }
}
?>      
<form action="register.php" method="post">
    <div class="sections">
        <label for="user">Nombre de Usuario:</label>
        <input type="text" id="user" name="user" value=""><br>
    </div>
    <div class="sections">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" ><br>
    </div>
    <div class="sections">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" ><br>
    </div>
    <input type="submit" name="submit" value="Registrarse">
</form>
<p>¿No tienes una cuenta? <a href="login.php">Ya posee una cuenta?</a></p>
</div>
</body>
</html>