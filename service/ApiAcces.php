<?php
namespace service;

class ApiAcces {
    public static function search($type, $content): string {
        $request = "https://api.deezer.com/search/" . urlencode($type) . "?q=" . urlencode($content) . "&limit=5"; // à refactor pour éviter de hard coder la limite
        $response = file_get_contents($request);  // Voir pour refactor avec curl
        
        if ($response === false) {
            return '{"data":[]}';
        }
    }
}