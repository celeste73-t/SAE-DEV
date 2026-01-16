<?php
namespace controller;

require_once 'vue/page/PageInscription.php';
require_once 'dao/UserDAO.php';
require_once 'model/User.php';
require_once 'service/Enum.php';

use vue\page\PageInscription;
use dao\UserDAO;
use model\User;
use service\UserRole;

class InscriptionController {
    private $errorMessage = null;

    public function index() {
        $page = new PageInscription("Inscription", $this->errorMessage);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function register() {
        $nom = $_POST['nom'] ?? ''; 
        $email = $_POST['email'] ?? ''; 
        $password = $_POST['password'] ?? ''; 
        
        // Validation basique 
        if (empty($nom) || empty($email) || empty($password)) { 
            $this->errorMessage = "Veuillez remplir tous les champs"; 
            $this->index(); 
            return; 
        }

        $dao = new UserDAO();

        if ($dao->findByEmail($email) !== null) {
            $this->errorMessage = "Un utilisateur avec cet email existe déjà";
            $this->index();
            return;
        }

        $hashedPassword = password_hash($password, algo: PASSWORD_BCRYPT);

        $user = new User(
            null,
            $email,
            $nom,
            $hashedPassword,
            UserRole::User
        );

        if (!$dao->newUser($user)) { 
            $this->errorMessage = "Erreur lors de l'inscription"; 
            $this->index(); 
            return; 
        }

        header('Location: index.php?page=connexion');
        exit();
    }
}
 