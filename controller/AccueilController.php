<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageAccueil.php';
require_once __DIR__ . '/../service/SessionManager.php';
require_once __DIR__ . '/../service/Enum.php';

use vue\page\PageAccueil;
use service\SessionManager;
use service\PhaseVote;

class AccueilController {
    public function index() {
        $session = SessionManager::getInstance();
        $phase = $session->getPhaseVote();// ?? 'preVote';

        $page = new PageAccueil("Accueil", $phase);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
?>