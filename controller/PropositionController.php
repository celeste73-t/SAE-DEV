<?php
namespace controller;

require_once 'vue/page/PageProposition.php';
require_once 'interfaces/categorie/ICategorieReader.php';
require_once 'service/ApiAcces.php';
require_once 'service/Enum.php';
require_once 'model/PropositionItem.php';

use vue\page\PageProposition;
use interfaces\categorie\ICategorieReader;
use service\ApiAcces;
use service\CategorieType;
use model\PropositionItem;

class PropositionController {
    private ICategorieReader $categorieReader;

    public function __construct(ICategorieReader $categorieReader) {
        $this->categorieReader = $categorieReader;
    }

    public function index($categorieId) {
        $_SESSION['categorieId'] = $categorieId; // Stocke l'ID de la catégorie dans la session car perdu lors de l'appel AJAX

        $categorie = $this->categorieReader->findById($categorieId);

        $page = new PageProposition("Propositions", $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function search($query) {
        $categorieId = $_SESSION['categorieId'] ?? null;

        $categorie = $this->categorieReader->findById($categorieId);

        $json = ApiAcces::search($categorie->getType()->value, $query);
        $data = json_decode($json, true);

        if (!isset($data['data'])) { 
            echo json_encode([]); 
            exit; 
        }

        foreach ($data['data'] as $t) {
            switch ($categorie->getType()) {
                case CategorieType::Track:
                    $results[] = [
                        "id" => $t['id'],
                        "titre" => $t['title'],
                        "artiste" => $t['artist']['name'],
                        "image" => $t['album']['cover']
                    ];
                    break;
                case CategorieType::Album:
                    $results[] = [
                        "id" => $t['id'],
                        "titre" => $t['title'],
                        "artiste" => $t['artist']['name'],
                        "image" => $t['cover']
                    ];
                    break;
                case CategorieType::Artist:
                    $results[] = [
                        "id" => $t['id'],
                        "titre" => $t['name'],
                        "artiste" => "",
                        "image" => $t['picture']
                    ];
                    break;
                default:
                    $results = [];
                    break;
            }
        }
        echo json_encode($results);
        exit;
    }

    public function select() {
        $data = json_decode(file_get_contents("php://input"), true); 
        
        $_SESSION['proposition'] = serialize(new PropositionItem(
            null,
            $data['id'], 
            $data['titre'], 
            $data['artiste'], 
            $data['image'] 
        )); 
        
        echo "OK"; 
        exit;
    }

}
