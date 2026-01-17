<?php
namespace controller;

require_once 'vue/page/PageResultat.php';
require_once 'interfaces/categorie/ICategorieReader.php';
require_once 'interfaces/resultat/IResultatReader.php';

use vue\page\PageResultat;
use interfaces\categorie\ICategorieReader;
use interfaces\resultat\IResultatReader;

class ResultatController {
    private ICategorieReader $categorieReader;
    private IResultatReader $resultatReader;

    public function __construct(ICategorieReader $categorieReader, IResultatReader $resultatReader) {
        $this->categorieReader = $categorieReader;
        $this->resultatReader = $resultatReader;
    }

    public function index($categorieId) {
        // recupérer la catégorie depuis la base de données
        $categorie = $this->categorieReader->findById($categorieId);

        // révupérer les resultat associées à cette catégorie
        $resultats = $this->resultatReader->getResultat($categorieId);

        $page = new PageResultat("Resultat", $categorie, $resultats);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 