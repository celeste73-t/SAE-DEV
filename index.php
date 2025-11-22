<?php

require_once __DIR__ . '/controller/AccueilController.php';
require_once __DIR__ . '/controller/AProposController.php';
require_once __DIR__ . '/controller/ConnexionController.php';
require_once __DIR__ . '/controller/ContactController.php';


use controller\AccueilController;
use controller\AProposController;
use controller\ConnexionController;
use controller\ContactController;


// La page par defaut est la page d'acceuil
$page = $_GET['page'] ?? 'accueil';

$action = $_GET['action'] ?? 'index';

// gestion des routes en fonction de l'url
switch ($page) {
    case 'accueil':
        $controller = new AccueilController();
        $controller->index();
        break;
    case 'aPropos':
        $controller = new AProposController();
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
    // autres routes...
    default:
        echo "404 - Page non trouvée";

    }
?>