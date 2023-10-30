<?php
include './config/database.php';
class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registerUser($username, $password, $email) {
        // Verificar si el usuario ya existe en la base de datos
        $query = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $query->execute([$username]);

        if ($query->rowCount() > 0) {
            return false; // El usuario ya existe
        }

        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Generar un token (puedes implementar esto según tus necesidades)
        $token = $this->generateToken();

        // Insertar el nuevo usuario en la base de datos
        $query = $this->db->prepare("INSERT INTO users (username, password, email, token) VALUES (?, ?, ?, ?)");
        $query->execute([$username, $hashedPassword, $email, $token]);

        return true;
    }

    public function loginUser($username, $password) {
        // Buscar el usuario en la base de datos
        $query = $this->db->prepare("SELECT id, password, token FROM users WHERE username = ?");
        $query->execute([$username]);

        if ($query->rowCount() == 1) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                // Actualizar el token
                $newToken = $this->generateToken();
                $query = $this->db->prepare("UPDATE users SET token = ? WHERE id = ?");
                //$query->execute([$newToken, $user['id']);
                return $user['id'];
            }
        }

        return false; // Autenticación fallida
    }

    public function getUserInfo($userId) {
        $query = $this->db->prepare("SELECT id, username, email FROM users WHERE id = ?");
        $query->execute([$userId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    private function generateToken() {
        // Generar un token aleatorio (puedes implementar esto según tus necesidades)
        return bin2hex(random_bytes(16));
    }
}

?>
