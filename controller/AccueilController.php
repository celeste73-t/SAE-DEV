<?php
namespace controller;

require_once 'vue/page/PageAccueil.php';
require_once 'dao/CategorieDAO.php';
require_once 'dao/EditionDAO.php';

use vue\page\PageAccueil;
use service\VotePhase;
use dao\CategorieDAO;
use dao\EditionDAO;

class AccueilController {
    public function index() {
        $phase = VotePhase::getPhaseVote();

        $editionDAO = new EditionDAO();
        $edition = $editionDAO->getActive();

        $categorieDAO = new CategorieDAO();
        $categories = $categorieDAO->getCategoriesForEdition($edition->getId());

        $page = new PageAccueil("Accueil", $phase, $categories);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 