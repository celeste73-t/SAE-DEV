<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageValidation.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../service/SessionManager.php';
require_once __DIR__ . '/../service/Enum.php';
require_once __DIR__ . '/../dao/UserCategorieStatusDAO.php';
require_once __DIR__ . '/../dao/PropositionDAO.php';
require_once __DIR__ . '/../dao/VoteDAO.php';
require_once __DIR__ . '/../service/VotePhase.php';

use vue\page\PageValidation;
use dao\CategorieDAO;
use service\SessionManager;
use service\UserRole;
use dao\UserCategorieStatusDAO;
use dao\PropositionDAO;
use dao\VoteDAO;
use service\VotePhase;
use service\PhaseVote;

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

        $phase = VotePhase::getPhaseVote();

        $page = new PageValidation("Validation", $proposition, $categorie, $phase);
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

        $phase = VotePhase::getPhaseVote();
        if ($phase == PhaseVote::Vote1) {
            $this->validateProposition($user, $session);
        } else if ($phase == PhaseVote::Vote2) {
            $this->validateVote($user, $session);
        } else {
            $session->setErrorMessage("La validation n'est pas autorisée pendant cette phase.");
            header('Location: index.php?page=accueil');
            exit;
        }
    }

    private function validateProposition($user, $session) {
        $statusDAO = new UserCategorieStatusDAO(); 
        
        $categorieId = $_SESSION['categorieId'];
        if ($statusDAO->getPropositionStatus($user->getId(), $categorieId)) { 
            $session->setErrorMessage("Vous avez déjà proposé dans cette catégorie."); 
            header("Location: index.php?page=accueil"); 
            exit; 
        }

        $proposition = unserialize($_SESSION['proposition']);

        $propositionDao = new PropositionDAO();
        $propositionDao->addProposition($proposition, $categorieId);

        $statusDAO->setPropositionStatus($user->getId(), $categorieId);

        $session->setSuccessMessage("Votre proposition a été prise en compte.");

        header('Location: index.php?page=accueil');
        exit();
    }

    private function validateVote($user, $session) {
        $statusDAO = new UserCategorieStatusDAO(); 
        
        $categorieId = $_SESSION['categorieId'];
        if ($statusDAO->getVoteStatus($user->getId(), $categorieId)) { 
            $session->setErrorMessage("Vous avez déjà voté dans cette catégorie."); 
            header("Location: index.php?page=accueil"); 
            exit; 
        }

        // Envoyer le vote à la base de données
        $proposition = unserialize($_SESSION['proposition']);
        
        $voteDAO = new VoteDAO();
        $voteDAO->addVote($proposition);

        $statusDAO->setVoteStatus($user->getId(), $categorieId);

        $session->setSuccessMessage("Votre vote a été pris en compte.");

        header('Location: index.php?page=accueil');
        exit();
    }
}
