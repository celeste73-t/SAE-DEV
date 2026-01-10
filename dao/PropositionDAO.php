<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';

use dao\DAO;

class PropositionDAO extends DAO {
    private function findItem($deezerId, $type) {
        $sql = "SELECT * FROM proposition_item WHERE deezerId = ? AND type = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$deezerId, $type]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function createItem($deezerId, $titre, $artist, $image, $type) {
        $sql = "INSERT INTO proposition_item (deezerId, titre, artist, image, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$deezerId, $titre, $artist, $image, $type]);
        return $this->db->lastInsertId();
    }

    public function addProposition($deezerId, $titre, $artist, $image, $type, $categorieId) {
        $item = $this->findItem($deezerId, $type);
        if ($item) {
            $itemId = $item['id'];
        } else {
            $itemId = $this->createItem($deezerId, $titre, $artist, $image, $type);
        }

        $sql = "INSERT INTO proposition (itemId, categorieId, dateProposition) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$itemId, $categorieId, date('Y-m-d H:i:s')]);

        return $this->db->lastInsertId();
    }
}
