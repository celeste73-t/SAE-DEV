<?php
namespace controller;

require_once 'service/SessionManager.php';
require_once 'vue/page/PageCandidat.php';
require_once 'interfaces/proposition/IPropositionReader.php';
require_once 'interfaces/categorie/ICategorieReader.php';
require_once 'model/PropositionItem.php';
require_once 'service/VotePhase.php';

use service\SessionManager;
use vue\page\PageCandidat;
use interfaces\proposition\IPropositionReader;
use interfaces\categorie\ICategorieReader;
use model\PropositionItem;
use service\VotePhase;

class CandidatController {
    private IPropositionReader $propositionReader;
    private ICategorieReader $categorieReader;

    public function __construct(IPropositionReader $propositionReader, ICategorieReader $categorieReader) {
        $this->propositionReader = $propositionReader;
        $this->categorieReader = $categorieReader;
    }

    public function index() {
        $phase = VotePhase::getPhaseVote();

        $session = SessionManager::getInstance();
        if (!$session->isCandidat()) {
            header("Location: index.php?page=accueil");
        }

        $propositionsRaw = $this->propositionReader->getNominatedPropositionsByCandidat($session->getUser()->getId());

        $propositions = [];
        $categories = [];
        foreach ($propositionsRaw as $entry) {
            $propositions[] = $entry["propositionItem"];

            $categories[] = $this->categorieReader->findById($entry['categorieId']);
        }

        $page = new PageCandidat("Espace Candidat", $phase, $propositions, $categories);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function select() {
        $data = json_decode(file_get_contents("php://input"), true); 
        $deezerId = $data['id']; 
        $categorieId = $data['categorie']; 
        $itemData = $this->propositionReader->findItem($deezerId);
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
