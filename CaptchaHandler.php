<?php

// CaptchaHandler.php

class CaptchaHandler {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->handlePost();
        } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->handleGet();
        }
    }

    private function handlePost() {
        header('Content-Type: application/json;charset=utf-8');
        
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        do {
            $textColor = $textColor ?? ColorUtils::generateRandomColor();
            $backgroundColor = $backgroundColor ?? ColorUtils::generateRandomColor();
        } while (!ColorUtils::colorContrast($textColor, $backgroundColor));
        
        $text = $data['text'] ?? bin2hex(random_bytes(6));
        $text = substr($text, 0, 24);
    
        $response = [];
    
        if ($this->db->isValidToken($token)) {
            if (!ColorUtils::isColorValid($textColor) || !ColorUtils::isColorValid($backgroundColor) || !ColorUtils::colorContrast($textColor, $backgroundColor)) {
                $response = ["error" => "Couleurs invalides ou contraste insuffisant."];
            } else {
                $captcha = new CaptchaGenerator($text, $textColor, $backgroundColor);
                $imagePath = $captcha->createImage();
                $captchaId = $this->db->saveCaptcha($text, $imagePath);
        
                if ($captchaId) {
                    $response = [
                        "captchaId" => $captchaId, 
                        "message" => "Captcha créé avec succès.",
                        "details" => [
                            "text" => $text,
                            "imagePath" => $imagePath
                        ]
                    ];
                } else {
                    $response = ["error" => "Erreur lors de la création du captcha."];
                }
            }
        } else {
            $response = ["error" => "Token invalide."];
        }
    
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
    
    

    private function handleGet() {
        $captchaId = $_GET['id'] ?? null;

        $response = [];

        if ($captchaId) {
            $captchaDetails = $this->db->getCaptchaDetails($captchaId);

            if ($captchaDetails) {
                header('Content-Type: application/json;charset=utf-8');
                $response = [
                    'imageUrl' => $captchaDetails['image_path'],
                    'text' => $captchaDetails['captcha_text']
                ];
            } else {
                $response = ['error' => "Captcha non trouvé."];
            }
        } else {
            $response = ['error' => "ID de captcha non spécifié."];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

}
