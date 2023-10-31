<?php
     class User {
        private $username;
        private $password;
        private $email;
        private $db;

        public function __construct($username, $password, $email, $db) {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->db = $db;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getEmail() {
            return $this->email;
        }

        public function authenticate($enteredPassword) {
            return password_verify($enteredPassword, $this->password);
        }
        public function registerUser($username, $password, $email) {
            // Hash de la contraseña (debes usar una función de hash segura como password_hash)
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            // Consulta SQL para insertar un nuevo usuario en la base de datos
            $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $hashedPassword, $email]);
    
            // Verifica si la inserción fue exitosa
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    
        public function loginUser($username, $password) {
            // Consulta SQL para obtener la contraseña almacenada para el usuario
            $query = "SELECT id, username, password FROM users WHERE username = ?";
    
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username]);
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Verifica si el usuario existe y si la contraseña coincide
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        }
    }
    
    // Ejemplo de uso:
    $db = new PDO("mysql:host=localhost;dbname=tarea27", "localhost", "");
    $user = new User($db);
    
    // Registro de usuario
    if ($user->registerUser("username", "password123", "user@example.com")) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error al registrar el usuario.";
    }
    
    // Inicio de sesión
    $loggedInUser = $user->loginUser("username", "password123");
    if ($loggedInUser) {
        echo "Inicio de sesión exitoso. ID: " . $loggedInUser['id'];
    } else {
        echo "Error de inicio de sesión.";
    }
    ?>