<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageResultat.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../dao/ResultatDAO.php';

use vue\page\PageResultat;
use dao\CategorieDAO;
use dao\ResultatDAO;

class ResultatController {
    public function index($categorieId) {
        // recupérer la catégorie depuis la base de données
        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        // révupérer les resultat associées à cette catégorie
        $resultatDAO = new ResultatDAO();
        $resultats = $resultatDAO->getResultat($categorieId);

        $page = new PageResultat("Resultat", $categorie, $resultats);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 