<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageConnexion.php';
use vue\page\PageConnexion;

class ConnexionController {
    public function index() {
        $page = new PageConnexion("Connexion");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
?>