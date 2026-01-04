<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageAccueil.php';

use vue\page\PageAccueil;
use service\SessionManager;
use service\VotePhase;

class AccueilController {
    public function index() {
        $phase = VotePhase::getPhaseVote();

        $page = new PageAccueil("Accueil", $phase);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 