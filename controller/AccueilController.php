<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageAccueil.php';
use vue\page\PageAccueil;

class AccueilController {
    public function index() {
        $page = new PageAccueil("Accueil");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 