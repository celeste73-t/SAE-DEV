<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageAccueil.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';

use vue\page\PageAccueil;
use service\SessionManager;
use service\VotePhase;
use dao\CategorieDAO;

class AccueilController {
    public function index() {
        $phase = VotePhase::getPhaseVote();
        $dao = new CategorieDAO();

        $categories = $dao->getAllCategories();

        $page = new PageAccueil("Accueil", $phase, $categories);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 