<?php
use Firebase\JWT\JWT;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        die("Nombre de Usuario, Email y Contraseña son requeridos");
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Email no válido");
    }
    if (strlen($_POST["password"]) < 8 || !preg_match("/[0-9]/", $_POST["password"])) {
        die("La contraseña debe ser de al menos 8 caracteres y contener al menos un número");
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Conexión a la base de datos
    $mysqli = require __DIR__ . "/database.php";

    // Insertar datos en la tabla "users"
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sss", $_POST["username"], $_POST["email"], $password_hash);
    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        
        // Generar un token JWT (implementación de ejemplo)
        $secret_key = 'tu_clave_secreta'; // Cambia esto por una clave segura
        $token = generateToken($user_id, $secret_key);
        
        echo "Registro exitoso. Token: $token";
    }else {
        if ($mysqli->errno == 1062) {
            die("Email ya registrado");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
}

    function generateToken($user_id, $secret_key) {
        $payload = array(
            "user_id" => $user_id,
            "exp" => time() + 3600 // Tiempo de expiración del token (1 hora)
        );
        $token = JWT::encode($payload, $secret_key, 'HS256');
        return $token;
    }
?>
