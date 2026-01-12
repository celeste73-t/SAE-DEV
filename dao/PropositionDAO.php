<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/PropositionItem.php';
require_once __DIR__ . '/../service/Enum.php';

use dao\DAO;
use PDO;
use model\PropositionItem;

class PropositionDAO extends DAO {
    public function findItem(int $deezerId) {
        $sql = "SELECT * FROM proposition_item WHERE deezerId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$deezerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findPropositionByDeezerId(int $deezerId) {
        $sql = "SELECT p.* 
                FROM proposition p
                JOIN proposition_item i ON p.itemId = i.id
                WHERE i.deezerId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$deezerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function createItem(PropositionItem $proposition): int {
        $sql = "INSERT INTO proposition_item (deezerId, titre, artist, image) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$proposition->getIdDeezer(),
                        $proposition->getTitre(), 
                        $proposition->getArtiste(), 
                        $proposition->getImage()]);
        return $this->db->lastInsertId();
    }

    public function addProposition(PropositionItem $proposition, int $categorieId): void {
        $item = $this->findItem($proposition->getIdDeezer());
        if ($item) {
            $itemId = $item['id'];
        } else {
            $itemId = $this->createItem($proposition);
        }

        $sql = "INSERT INTO proposition (dateProposition, itemId, categorieId, candidatId) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([date('Y-m-d H:i:s'), $itemId, $categorieId, 1]); # Emule une atribution automatique du compte

        return;
    }


    public function getNominatedPropositions($categorieId): array {
        $sql = "SELECT 
                    i.id AS itemId,
                    i.deezerId,
                    i.titre,
                    i.artist,
                    i.image,
                    COUNT(p.id) AS nb
                FROM proposition p
                JOIN proposition_item i ON p.itemId = i.id
                WHERE p.categorieId = ?
                GROUP BY i.id, i.deezerId, i.titre, i.artist, i.image
                ORDER BY nb DESC
                LIMIT 5";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categorieId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($rows as $row) {
            $items[] = new PropositionItem(
                $row['itemId'],
                $row['deezerId'],
                $row['titre'],
                $row['artist'],
                $row['image']
            );
        }
    return $items;
}


    public function getPropositionByCandidat(int $userId): array {
        $sql = "SELECT p.id AS propositionId, 
                               p.dateProposition, 
                               p.categorieId, i.id AS itemId, 
                               i.deezerId, 
                               i.titre, 
                               i.artist, 
                               i.image 
                FROM proposition p 
                JOIN proposition_item i ON p.itemId = i.id 
                WHERE p.candidatId = ? 
                ORDER BY p.dateProposition DESC";

        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId]); 
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $propositions = [];

        foreach ($rows as $row) {
            $item = new PropositionItem( 
                $row['itemId'],
                $row['deezerId'], 
                $row['titre'], 
                $row['artist'], 
                $row['image'] 
            );

            $propositions[] = [ 
                "propositionId" => $row['propositionId'], 
                "categorieId" => $row['categorieId'], // pas sur de l'utiliter ?
                "item" => $item 
            ];
        }
        return $propositions;
    }
}
