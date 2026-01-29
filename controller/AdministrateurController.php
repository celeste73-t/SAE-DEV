<?php
namespace controller;

require_once 'vue/page/PageAdministrateur.php';
require_once 'interfaces/edition/IEditionReader.php';
require_once 'interfaces/edition/IEditionWriter.php';
require_once 'model/Edition.php';

use vue\page\PageAdministrateur;
use interfaces\edition\IEditionReader;
use interfaces\edition\IEditionWriter;
use model\Edition;
use DateTime;
use service\SessionManager;

class AdministrateurController {
    private IEditionReader $editionReader;
    private IEditionWriter $editionWriter;

    public function __construct(IEditionReader $editionReader, IEditionWriter $editionWriter) {
        $this->editionReader = $editionReader;
        $this->editionWriter = $editionWriter;
    }

    public function index() {
        $editions = $this->editionReader->getEditions();

        $page = new PageAdministrateur("Espace Administrateur", $editions);
        $page->render();
    }

    public function validate() {
        // récupérer les post 
        $id = $_POST["activeEdition"] ?? ""; 
        $nom = $_POST["nom"] ?? ""; 
        $dateProposition = $_POST["dateProposition"] ?? ""; 
        $dateVote = $_POST["dateVote"] ?? ""; 
        $dateResultat = $_POST["dateResultat"] ?? "";

        $sessionManager = SessionManager::getInstance();

        if(empty($nom) || empty($dateProposition) || empty($dateVote) || empty($dateResultat)) {
            $sessionManager->setErrorMessage("Veuillez remplir les champs");
            header('Location: index.php?page=accueil');
            exit;
        }

        if (!$sessionManager->isAdmin()) {
            $sessionManager->setErrorMessage("Vous devez etre connecté en tant qu'adimnistrateur pour effectuer cette action");
            header('Location: index.php?page=accueil');
            exit;
        }

        $edition = new Edition(
            null, 
            $nom, 
            new DateTime($dateProposition), 
            new DateTime($dateVote),  
            new DateTime($dateResultat),  
            true);

        if($id == "new") {
            $this->editionWriter->createEdition($edition);
            $sessionManager->setSuccessMessage("Cette nouvelle édition à été créer et est maintenant active");
            header('Location: index.php?page=accueil');
            exit;
        } else {
            $this->editionWriter->updateEdition((int)$id, $edition);
            $sessionManager->setSuccessMessage("Cette édition à été modifier et est maintenant active");
            header('Location: index.php?page=accueil');
            exit;
        }
    }

    public function delete() {
        $sessionManager = SessionManager::getInstance();

        if (!$sessionManager->isAdmin()) {
            $sessionManager->setErrorMessage("Vous devez etre connecté en tant qu'adimnistrateur pour effectuer cette action");
            header('Location: index.php?page=accueil');
            exit;
        }
        // verif active
    }
}