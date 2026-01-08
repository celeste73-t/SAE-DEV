<?php
namespace service;

require_once __DIR__ . '/Enum.php';
require_once __DIR__ . '/VotePhase.php';


class SessionManager {
    private static ?SessionManager $instance = null;

    public static function getInstance(): SessionManager {
        if (self::$instance === null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function setUser($user) { 
        $_SESSION['user'] = serialize($user); 
    } 
    
    public function getUser() { 
        if (!isset($_SESSION['user'])) 
            return null; 
        return unserialize($_SESSION['user']); 
    }

    public function isLogged() { 
        return isset($_SESSION['user']); 
    } 
}