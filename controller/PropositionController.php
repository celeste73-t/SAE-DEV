<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageProposition.php';

use vue\page\PageProposition;

class PropositionController {
    public function index($categorie) {
        $page = new PageProposition("Propositions");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
