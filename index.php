<?php

require_once __DIR__ . '/service/SessionManager.php';
require_once __DIR__ . '/controller/AccueilController.php';
require_once __DIR__ . '/controller/AProposController.php';
require_once __DIR__ . '/controller/CandidatController.php';
require_once __DIR__ . '/controller/CGUController.php';
require_once __DIR__ . '/controller/ConnexionController.php';
require_once __DIR__ . '/controller/ContactController.php';
require_once __DIR__ . '/controller/InscriptionController.php';
require_once __DIR__ . '/controller/PropositionController.php';
require_once __DIR__ . '/controller/ResultatController.php';
require_once __DIR__ . '/controller/ValidationController.php';
require_once __DIR__ . '/controller/VoteController.php';
require_once __DIR__ . '/controller/composant/PostController.php';
require_once __DIR__ . '/controller/composant/CommentaireController.php';

use service\SessionManager;
use controller\AccueilController;
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

// La page par defaut est la page d'acceuil
$page = $_GET['page'] ?? 'accueil';

$action = $_GET['action'] ?? 'index';

// gestion des routes en fonction de l'url
switch ($page) {
    case 'accueil':
        if (SessionManager::getInstance()->isCandidat()) {
            header("Location: index.php?page=candidat");
        }
        $controller = new AccueilController();
        $controller->index();
        break;
    case 'aPropos':
        $controller = new AProposController();
        $controller->index();
        break;
    case 'candidat':
        $controller = new CandidatController();
        $controller->index();
        break;
    case 'cgu':
        $controller = new CGUController();
        $controller->index();
        break;
    case 'connexion':
        $controller = new ConnexionController();
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
        $controller = new InscriptionController();
        if ($action === "register") {
            $controller->register();
        } else {
            $controller->index();
        }
        break;
    case 'proposition':
        $controller = new PropositionController();
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
        $controller = new ResultatController();
        $categorie = $_GET['categorie'] ?? null;
        $controller->index($categorie);
        break;
    case 'validation':
        $controller = new ValidationController();
        if ($action === "validate") {
            $controller->validate();
        } else {
            $controller->index();
        }
        break;
    case 'vote':
        $controller = new VoteController();
        if ($action === "select") {
            $controller->select();
        } else {
            $categorie = $_GET['categorie'] ?? null;
            $controller->index($categorie);
        }
        break;
    case 'post':
        $controller = new PostController();
        if ($action === 'create') {
            $controller->create();
        }
        break;
    case 'commentaire':
        $controller = new CommentaireController();
        if ($action === 'create') {
            $controller->create();
        }
        break;

    // autres routes...
    default:
        echo "404 - Page non trouvée";
    }