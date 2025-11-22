<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageConnexion.php';
require_once __DIR__ . '/../dao/UserDAO.php';

use vue\page\PageConnexion;
use dao\UserDAO;

class ConnexionController {
    private $errorMessage = null;
    private $successMessage = null;

    public function index() {
        $page = new PageConnexion("Connexion", $this->errorMessage, $this->successMessage);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validation basique
        if (empty($email) || empty($password)) {
            $this->errorMessage = "Veuillez remplir tous les champs";
            $this->index();
            return;
        }

        $userDAO = new UserDAO();
        $user = $userDAO->findByEmail($email);

        if (!$user) {
            $this->errorMessage = "Email ou mot de passe incorrect";
            $this->index();
            return;
        }

        if (!password_verify($password, $user->getPassword())) {
            $this->errorMessage = "Email ou mot de passe incorrect";
            $this->index();
            return;
        }
        
        $session = SessionManager::getInstance();
        $userRole = UserRole::from($user->getRole());
        $session->setUserRole($userRole);

        // Redirection vers la page d'accueil
        header('Location: index.php?page=accueil');
        exit();
    }

    public function logout() {
        // Détruire la session
        session_start();
        session_unset();
        session_destroy();

        // Redirection vers la page d'accueil
        header('Location: index.php?page=accueil');
        exit();
    }
}
?>