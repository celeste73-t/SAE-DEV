<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageValidation.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../service/SessionManager.php';
require_once __DIR__ . '/../service/Enum.php';
require_once __DIR__ . '/../dao/UserCategorieStatusDAO.php';
require_once __DIR__ . '/../dao/PropositionDAO.php';

use vue\page\PageValidation;
use dao\CategorieDAO;
use service\SessionManager;
use service\UserRole;
use dao\UserCategorieStatusDAO;
use dao\PropositionDAO;

class ValidationController {

    public function index() {
        $categorieId = $_SESSION['categorieId'] ?? null;

        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        if (!isset($_SESSION['proposition'])) { 
            echo "Aucune proposition sélectionnée"; 
            exit; 
        }
        $proposition = unserialize($_SESSION['proposition']);

        $page = new PageValidation("Validation", $proposition, $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function validate() {
        $session = SessionManager::getInstance();
        if (!$session->isLogged()) {
            $session->setErrorMessage("Vous devez être connecté pour valider une proposition.");
            header('Location: index.php?page=connexion');
            exit;
        }

        $user = $session->getUser();
        if ($user->getRole() !== UserRole::User) {
            $session->setErrorMessage("Veuillez vous connecter en tant qu'utilisateur pour valider une proposition.");
            header('Location: index.php?page=accueil');
            exit;
        }

        $statusDAO = new UserCategorieStatusDAO(); 
        
        $categorieId = $_SESSION['categorieId'];
        if ($statusDAO->getPropositionStatus($user->getId(), $categorieId)) { 
            $session->setErrorMessage("Vous avez déjà proposé dans cette catégorie."); 
            header("Location: index.php?page=accueil"); 
            exit; 
        }

        $proposition = unserialize($_SESSION['proposition']);

        $propositionDao = new PropositionDAO();
        $propositionDao->addProposition(
            $proposition->getId(),
            $proposition->getTitre(),
            $proposition->getArtiste(),
            $proposition->getImage(),
            $proposition->getType(),
            $categorieId
        );

        $statusDAO->setPropositionStatus($user->getId(), $categorieId);

        $session->setSuccessMessage("Votre proposition a été prise en compte.");

        header('Location: index.php?page=accueil');
        exit();
    }
}
