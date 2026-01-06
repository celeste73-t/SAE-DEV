<?php
namespace service;

require_once __DIR__ . '/Enum.php';
require_once __DIR__ . '/VotePhase.php';


class SessionManager {
    private static ?SessionManager $instance = null;
    private UserRole $userRole;
    private PhaseVote $phaseVote;

    private function __construct() {
        $this->initSession();
    }

    public static function getInstance(): SessionManager {
        if (self::$instance === null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    protected function initSession() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = UserRole::Visiteur->value;
        }
        $this->userRole = UserRole::from($_SESSION['user']);
    }

    public function getUserRole(): UserRole {
        return $this->userRole;
    }

    public function setUserRole(UserRole $role): void {
        $this->userRole = $role;
        $_SESSION['user'] = $role->value;
    }
}