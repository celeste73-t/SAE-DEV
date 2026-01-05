<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageProposition.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';

use vue\page\PageProposition;
use dao\CategorieDAO;

class PropositionController {
    private $categorie;

    public function index($categorieId) {
        $categorieDAO = new CategorieDAO();
        $this->categorie = $categorieDAO->findById($categorieId);
        $page = new PageProposition("Propositions");
        $page->render($this->categorie); // le contrôleur déclenche l’affichage
    }
}
