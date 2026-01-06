<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageProposition.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';

use vue\page\PageProposition;
use dao\CategorieDAO;

class PropositionController {
    public function index($categorieId) {
        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);
        $page = new PageProposition("Propositions", $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
