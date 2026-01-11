<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageCGU.php';

use vue\page\PageCGU;

class CGUController {
    public function index() {
        $page = new PageCGU("Conditions Générales d'Utilisation (CGU)");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
