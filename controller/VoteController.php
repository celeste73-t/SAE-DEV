<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageVote.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../dao/PropositionDAO.php';

use vue\page\PageVote;
use dao\CategorieDAO;
use dao\PropositionDAO;

class VoteController {
    public function index($categorieId) {
        // recupérer la catégorie depuis la base de données
        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        // révupérer les propositions associées à cette catégorie
        $propositionDAO = new PropositionDAO();
        $propositions = $propositionDAO->getNominatedPropositions($categorieId);

        $page = new PageVote("Vote", $categorie, $propositions);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 