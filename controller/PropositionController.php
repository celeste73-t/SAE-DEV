<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageProposition.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../service/ApiAcces.php';

use vue\page\PageProposition;
use dao\CategorieDAO;
use service\ApiAcces;

class PropositionController {

    public function index($categorieId) {
        $_SESSION['categorieId'] = $categorieId; // Stocke l'ID de la catégorie dans la session car perdu lors de l'appel AJAX

        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        $page = new PageProposition("Propositions", $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function search($query) {
        $categorieId = $_SESSION['categorieId'] ?? null;

        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        $json = ApiAcces::search($categorie->getType()->value, $query); 
        echo $json; 
        
        exit;
    }
}
