<?php
namespace controller;

require_once 'vue/page/PageAccueil.php';
require_once 'interfaces/edition/IEditionReader.php';
require_once 'interfaces/categorie/ICategorieReader.php';

use vue\page\PageAccueil;
use service\VotePhase;
use interfaces\edition\IEditionReader;
use interfaces\categorie\ICategorieReader;

class AccueilController {
    private IEditionReader $editionReader;
    private ICategorieReader $categorieReader;

    public function __construct(IEditionReader $editionReader, ICategorieReader $categorieReader) {
        $this->editionReader = $editionReader;
        $this->categorieReader = $categorieReader;
    }

    public function index() {
        $phase = VotePhase::getPhaseVote();

        $edition = $this->editionReader->getActive();

        $categories = $this->categorieReader->getCategoriesFromEdition($edition->getId());

        $page = new PageAccueil("Accueil", $phase, $categories);
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 