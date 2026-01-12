<?php
namespace controller;

require_once __DIR__ . '/../service/SessionManager.php';
require_once __DIR__ .'/../vue/page/PageCandidat.php';

use service\SessionManager;
use vue\page\PageCandidat;

class CandidatController {
    public function index() {
        if (!SessionManager::getInstance()->isCandidat()) {
            header("Location: index.php?page=accueil");
        }

        $page = new PageCandidat(title: "Espace Candidat");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
