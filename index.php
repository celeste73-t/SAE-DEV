<?php

require_once 'service/SessionManager.php';
require_once 'dao/CategorieDAO.php';
require_once 'dao/EditionDAO.php';
require_once 'dao/EditionDAO.php';
require_once 'dao/PropositionDAO.php';
require_once 'dao/UserDAO.php';
require_once 'dao/ResultatDAO.php';
require_once 'dao/PostDAO.php';
require_once 'dao/CommentaireDAO.php';
require_once 'dao/UserCategorieStatusDAO.php';
require_once 'dao/VoteDAO.php';
require_once 'controller/AccueilController.php';
require_once 'controller/AdministrateurController.php';
require_once 'controller/AProposController.php';
require_once 'controller/CandidatController.php';
require_once 'controller/CGUController.php';
require_once 'controller/ConnexionController.php';
require_once 'controller/ContactController.php';
require_once 'controller/InscriptionController.php';
require_once 'controller/PropositionController.php';
require_once 'controller/ResultatController.php';
require_once 'controller/ValidationController.php';
require_once 'controller/VoteController.php';
require_once 'controller/composant/PostController.php';
require_once 'controller/composant/CommentaireController.php';

use service\SessionManager;
use dao\CategorieDAO;
use dao\EditionDAO;
use dao\PropositionDAO;
use dao\UserDAO;
use dao\ResultatDAO;
use dao\PostDAO;
use dao\CommentaireDAO;
use dao\UserCategorieStatusDAO;
use dao\VoteDAO;
use controller\AccueilController;
use controller\AdministrateurController;
use controller\AProposController;
use controller\CandidatController;
use controller\CGUController;
use controller\ConnexionController;
use controller\ContactController;
use controller\InscriptionController;
use controller\PropositionController;
use controller\ResultatController;
use controller\ValidationController;
use controller\VoteController;
use controller\composant\PostController;
use controller\composant\CommentaireController;

session_start();

// Création des dao
$categorieDAO = new CategorieDAO();
$editionDAO = new EditionDAO();
$propositionDAO = new PropositionDAO();
$userDAO = new UserDAO();
$resultatDAO = new ResultatDAO();
$postDAO = new PostDAO();
$commentaireDAO = new CommentaireDAO();
$userCategorieStatusDAO = new UserCategorieStatusDAO();
$voteDAO = new VoteDAO();

// La page par defaut est la page d'acceuil
$page = $_GET['page'] ?? 'accueil';

$action = $_GET['action'] ?? 'index';

// gestion des routes en fonction de l'url
switch ($page) {
    case 'accueil':
        if (SessionManager::getInstance()->isCandidat()) {
            header("Location: index.php?page=candidat");
        } if (SessionManager::getInstance()->isAdmin()) {
            header("Location: index.php?page=admin");
        }
        $controller = new AccueilController($editionDAO, $categorieDAO);
        $controller->index();
        break;
    case 'admin':
        $controller = new AdministrateurController($editionDAO, $editionDAO);
        if ($action == "validate") {
            $controller->validate();
        } else {
            $controller->index();
        }
        break;
    case 'aPropos':
        $controller = new AProposController();
        $controller->index();
        break;
    case 'candidat':
        $controller = new CandidatController($propositionDAO, $categorieDAO);
        $controller->index();
        break;
    case 'cgu':
        $controller = new CGUController();
        $controller->index();
        break;
    case 'connexion':
        $controller = new ConnexionController($userDAO);
        if ($action === "login") {
            $controller->login();
        }elseif ($action === 'logout') {
            $controller->logout();
        } else {
            $controller->index();
        }
        break;
    case 'contact':
        $controller = new ContactController();
        $controller->index();
        break;
    case 'inscription':
        $controller = new InscriptionController($userDAO, $userDAO);
        if ($action === "register") {
            $controller->register();
        } else {
            $controller->index();
        }
        break;
    case 'proposition':
        $controller = new PropositionController($categorieDAO);
        if ($action === "search") {
            $query = $_GET['q'] ?? null;
            $controller->search($query);
        } else if ($action === "select") {
            $controller->select();
        } else {
            $categorie = $_GET['categorie'] ?? null;
            $controller->index($categorie);
        }
        break;
    case 'resultat':
        $controller = new ResultatController($categorieDAO, $resultatDAO);
        $categorie = $_GET['categorie'] ?? null;
        $controller->index($categorie);
        break;
    case 'validation':
        $controller = new ValidationController($categorieDAO, $propositionDAO, $propositionDAO, $postDAO, $postDAO, $commentaireDAO, $commentaireDAO, $userCategorieStatusDAO, $userCategorieStatusDAO, $editionDAO, $voteDAO);
        if ($action === "validate") {
            $controller->validate();
        } else {
            $controller->index();
        }
        break;
    case 'vote':
        $controller = new VoteController($categorieDAO, $propositionDAO);
        if ($action === "select") {
            $controller->select();
        } else {
            $categorie = $_GET['categorie'] ?? null;
            $controller->index($categorie);
        }
        break;
    case 'post':
        $controller = new PostController($postDAO, $commentaireDAO,$commentaireDAO);
        if ($action === 'create') {
            $controller->create();
        }
        break;
    case 'commentaire':
        $controller = new CommentaireController($commentaireDAO, $commentaireDAO);
        if ($action === 'create') {
            $controller->create();
        }
        break;

    // autres routes...
    default:
        echo "404 - Page non trouvée";
    }