<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';

use dao\DAO;
use PDO;

class PropositionDAO extends DAO {
    private function findItem($deezerId, $type) {
        $sql = "SELECT * FROM proposition_item WHERE deezerId = ? AND type = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$deezerId, $type]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function createItem($proposition) {
        $sql = "INSERT INTO proposition_item (deezerId, titre, artist, image, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$proposition->getIdDeezer(),
                        $proposition->getTitre(), 
                        $proposition->getArtiste(), 
                        $proposition->getImage(), 
                        $proposition->getType()]);
        return $this->db->lastInsertId();
    }

    public function addProposition($proposition, $categorieId) {
        $item = $this->findItem($proposition->getIdDeezer(),
                                $proposition->getType());
        if ($item) {
            $itemId = $item['id'];
        } else {
            $itemId = $this->createItem($proposition, $type);
        }

        $sql = "INSERT INTO proposition (itemId, categorieId, dateProposition) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$itemId, $categorieId, date('Y-m-d H:i:s')]);

        return $this->db->lastInsertId();
    }

    public function getNominatedPropositions($categorieId) {
        $sql = "SELECT itemId, COUNT(*) AS nb 
                FROM proposition 
                WHERE categorieId = ? 
                GROUP BY itemId 
                ORDER BY nb DESC 
                LIMIT 5 ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categorieId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($rows as $row) {
            $sqlItem = "SELECT * FROM proposition_item WHERE id = ?"; 
            $stmtItem = $this->db->prepare($sqlItem); 
            $stmtItem->execute([$itemId]); 
            $itemData = $stmtItem->fetch(PDO::FETCH_ASSOC);

        }

    }
}
