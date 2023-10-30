<?php
require_once('./config/database.php'); // Asegúrate de que esta línea incluye el archivo database.php
require_once('auth.php');
$auth = new Auth();
class API {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        // Verificar las credenciales del usuario en la base de datos
        $auth = new Auth($this->conn);
        $user = $auth->authenticateUser($username, $password);

        if ($user) {
            // Generar un token de autenticación (puedes personalizar esto)
            $token = bin2hex(random_bytes(32));

            // Almacenar el token en la base de datos o en una tabla de tokens
            // Asocia el token al usuario para futuras verificaciones

            // Devolver el token en formato JSON
            $response = [
                'token' => $token,
            ];
            echo json_encode($response);
        } else {
            // Credenciales incorrectas
            http_response_code(401);
            echo json_encode(['message' => 'Credenciales incorrectas']);
        }
    }

    public function register($username, $password, $email) {
        // Registrar al usuario en la base de datos
        $auth = new Auth($this->conn);
        $result = $auth->registerUser($username, $password, $email);

        if ($result) {
            // Usuario registrado con éxito
            http_response_code(201);
            echo json_encode(['message' => 'Usuario registrado con éxito']);
        } else {
            // Error al registrar el usuario
            http_response_code(500);
            echo json_encode(['message' => 'Error al registrar el usuario']);
        }
    }

    // Agregar esta función para verificar el token de autorización
    public function verifyToken($token) {
        // Verificar el token en la base de datos o en la tabla de tokens
        // Asegurarse de que el token sea válido y está asociado a un usuario

        // Si el token es válido, devuelve true; de lo contrario, devuelve false
        return true; // Debes implementar la lógica real de verificación
    }

    public function getProtectedData() {
        // Endpoint protegido, requiere token de autorización
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);

            if ($this->verifyToken($token)) {
                // Devuelve datos protegidos
                echo json_encode(['message' => 'Estos son datos protegidos']);
            } else {
                // Token inválido
                http_response_code(401);
                echo json_encode(['message' => 'Token inválido']);
            }
        } else {
            // Token no proporcionado
            http_response_code(401);
            echo json_encode(['message' => 'Token no proporcionado']);
        }
    }
}
