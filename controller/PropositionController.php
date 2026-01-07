<?php
namespace controller;

require_once __DIR__ . '/../vue/page/PageProposition.php';
require_once __DIR__ . '/../dao/CategorieDAO.php';
require_once __DIR__ . '/../service/ApiAcces.php';
require_once __DIR__ . '/../model/Artist.php';
require_once __DIR__ . '/../model/Album.php';
require_once __DIR__ . '/../model/Track.php';

use vue\page\PageProposition;
use dao\CategorieDAO;
use service\ApiAcces;
use model\Artist;
use model\Album;
use model\Track;

class PropositionController {

    public function index($categorieId) {
        $_SESSION['categorieId'] = $categorieId; // Stocke l'ID de la catégorie dans la session car perdu lors de l'appel AJAX

        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        $page = new PageProposition("Propositions", $categorie);
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function search($query) {
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');

        $categorieId = $_SESSION['categorieId'] ?? null;

        $categorieDAO = new CategorieDAO();
        $categorie = $categorieDAO->findById($categorieId);

        $json = ApiAcces::search($categorie->getType()->value, $query);
        $data = json_decode($json, true);

        $results = [];

        if (isset($data['data'])) {
            foreach ($data['data'] as $t) {

                $artist = new \model\Artist(
                    $t['artist']['name'] ?? "Inconnu",
                    $t['artist']['picture'] ?? ""
                );

                $album = new \model\Album(
                    $t['album']['title'] ?? "Sans titre",
                    $artist,
                    $t['album']['cover'] ?? ""
                );

                $track = new \model\Track(
                    $t['title'],
                    $artist,
                    $album
                );

                $results[] = $track;
            }
        }

        echo json_encode(array_map(function($track) {
            return [
                "titre" => $track->getTitre(),
                "artiste" => [
                    "nom" => $track->getArtiste()->getNom(),
                    "image" => $track->getArtiste()->getImage()
                ],
                "album" => [
                    "titre" => $track->getAlbum()->getTitre(),
                    "image" => $track->getAlbum()->getImage()
                ]
            ];
        }, $results));

        exit;
    }

}
