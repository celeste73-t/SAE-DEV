<?php
namespace controller;

require_once 'vue/page/PageAPropos.php';

use vue\page\PageAPropos;

class AProposController {
    public function index() {
        $page = new PageAPropos("À Propos");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 