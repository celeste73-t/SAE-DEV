<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageVote.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';

use vue\page\PageVote;
use dao\CategorieDAO;

class VoteController {
    public function index($categorieId) {
        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);
        $page = new PageVote("Vote", $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 