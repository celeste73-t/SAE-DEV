<?php
namespace service;

require_once __DIR__ . '/Enum.php';
require_once __DIR__ . '/VotePhase.php';

use service\UserRole;

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

    public function isCandidat() {
        $user = $this->getUser();
        if ($user === null){
            return false;
        }
        else {
            return $user->getRole() == UserRole::Candidat;
        }
    }

    public function setSuccessMessage(string $message) {
        $_SESSION['successMessage'] = $message;
    }

    public function getSuccessMessage(): ?string {
        $message = $_SESSION['successMessage'] ?? null;
        unset($_SESSION['successMessage']);
        return $message;
    }

    public function setErrorMessage(string $message) {
        $_SESSION['errorMessage'] = $message;
    }

    public function getErrorMessage(): ?string {
        $message = $_SESSION['errorMessage'] ?? null;
        unset($_SESSION['errorMessage']);
        return $message;
    }
}