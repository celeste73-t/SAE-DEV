<?php
namespace controller;

require_once 'vue/page/PageVote.php';
require_once 'interfaces/categorie/ICategorieReader.php';
require_once 'interfaces/proposition/IPropositionReader.php';
require_once 'model/PropositionItem.php';

use vue\page\PageVote;
use interfaces\categorie\ICategorieReader;
use interfaces\proposition\IPropositionReader;
use model\PropositionItem;

class VoteController {
    private ICategorieReader $categorieReader;
    private IPropositionReader $propositionReader;

    public function __construct(ICategorieReader $categorieReader, IPropositionReader $propositionReader) {
        $this->categorieReader = $categorieReader;
        $this->propositionReader = $propositionReader;
    }

    public function index($categorieId) {
        // recupérer la catégorie depuis la base de données
        $categorie = $this->categorieReader->findById($categorieId);

        // révupérer les propositions associées à cette catégorie
        $propositions = $this->propositionReader->getNominatedPropositions($categorieId);

        $page = new PageVote("Vote", $categorie, $propositions);
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
 