<?php
require_once('./config/database.php');
require_once('auth.php');
$auth = new Auth();
class API
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        $auth = new Auth($this->conn);
        $user = $auth->authenticateUser($username, $password);

        if ($user) {
            $token = bin2hex(random_bytes(32));

            $response = [
                'token' => $token,
            ];
            echo json_encode($response);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Credenciales incorrectas']);
        }
    }

    public function register($username, $password, $email)
    {
        $auth = new Auth($this->conn);
        $result = $auth->registerUser($username, $password, $email);

        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => 'Usuario registrado con éxito']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Error al registrar el usuario']);
        }
    }

    public function verifyToken($token)
    {
        return true;
    }

    public function getProtectedData()
    {
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);

            if ($this->verifyToken($token)) {
                echo json_encode(['message' => 'Estos son datos protegidos']);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Token inválido']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Token no proporcionado']);
        }
    }
}
