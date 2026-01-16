<?php
namespace controller;

require_once 'service/SessionManager.php';
require_once 'vue/page/PageCandidat.php';
require_once 'dao/PropositionDAO.php';
require_once 'dao/CategorieDAO.php';
require_once 'model/PropositionItem.php';
require_once 'service/VotePhase.php';

use service\SessionManager;
use vue\page\PageCandidat;
use dao\PropositionDAO;
use dao\CategorieDAO;
use model\PropositionItem;
use service\VotePhase;

class CandidatController {
    public function index() {
        $phase = VotePhase::getPhaseVote();

        $session = SessionManager::getInstance();
        if (!$session->isCandidat()) {
            header("Location: index.php?page=accueil");
        }

        $propositionDAO = new PropositionDAO(); 
        $propositionsRaw = $propositionDAO->getNominatedPropositionsByCandidat($session->getUser()->getId());

        $categorieDAO = new CategorieDAO();

        $propositions = [];
        $categories = [];
        foreach ($propositionsRaw as $entry) {
            $propositions[] = $entry["propositionItem"];

            $categories[] = $categorieDAO->findById($entry['categorieId']);
        }

        $page = new PageCandidat("Espace Candidat", $phase, $propositions, $categories);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function select() {
        $data = json_decode(file_get_contents("php://input"), true); 
        $deezerId = $data['id']; 
        $categorieId = $data['categorie']; 
        $propositionDAO = new PropositionDAO();
        $itemData = $propositionDAO->findItem($deezerId);
        $proposition = new PropositionItem(
            $itemData['id'],
            $itemData['deezerId'], 
            $itemData['titre'], 
            $itemData['artist'], 
            $itemData['image'] 
        ); 
        $_SESSION['proposition'] = serialize($proposition); 
        $_SESSION['categorieId'] = $categorieId; 
    }
}
