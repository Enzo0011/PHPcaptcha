<?php

// Database.php

class Database {
    private $conn;

    public function __construct() {
        $host = 'localhost';
        $db = 'captcha_db';
        $user = 'user_captcha';
        $pass = 'root123_password';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function saveCaptcha($text, $imagePath) {
        $query = "INSERT INTO captchas (captcha_text, image_path) VALUES (:text, :image_path)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['text' => $text, 'image_path' => $imagePath]);

        return $this->conn->lastInsertId();
    }

    public function isValidToken($token) {
        $query = "SELECT * FROM auth_tokens WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['token' => $token]);

        return $stmt->fetch() !== false;
    }

    public function getCaptchaDetails($id) {
        $query = "SELECT captcha_text, image_path FROM captchas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    
}
