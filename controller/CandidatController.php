<?php
namespace controller;

require_once __DIR__ . '/../service/SessionManager.php';
require_once __DIR__ . '/../vue/page/PageCandidat.php';
require_once __DIR__ . '/../dao/PropositionDAO.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../service/VotePhase.php';

use service\SessionManager;
use vue\page\PageCandidat;
use dao\PropositionDAO;
use dao\CategorieDAO;
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
}
