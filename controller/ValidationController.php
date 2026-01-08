<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageValidation.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';

use vue\page\PageValidation;
use dao\CategorieDAO;

class ValidationController {

    public function index() {
        $categorieId = $_SESSION['categorieId'] ?? null;

        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        if (!isset($_SESSION['proposition'])) { 
            echo "Aucune proposition sélectionnée"; 
            exit; 
        }
        $proposition = unserialize($_SESSION['proposition']);

        $page = new PageValidation("Validation", $proposition, $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function validate() {
        // Logique de validation de la proposition
        // Par exemple, enregistrer la proposition dans la base de données

        // Après validation, nettoyer la session
        unset($_SESSION['proposition']);
        unset($_SESSION['categorieId']);

        header('Location: index.php?page=accueil');
        exit();
    }
}
