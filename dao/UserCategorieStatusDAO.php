<?php
namespace dao;

require_once __DIR__ . '/../service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;
use PDOException;

class UserCategorieStatusDAO {
    private PDO $db;

    public function __construct() {
        // Injection de la dépendance PDO en utilisant la méthode statique connect()
        $this->db = ConnectionBDD::connect();
    }

    private function findRow($userId, $categorieId) { 
        $sql = "SELECT * 
                FROM user_categorie_status 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
        return $stmt->fetch(\PDO::FETCH_ASSOC); 
    } 
    
    private function createRow($userId, $categorieId) { 
        $sql = "INSERT INTO user_categorie_status (utilisateurId, categorieId, aPropose, aVote) 
                VALUES (?, ?, 0, 0)"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    } 
    
    private function ensureRowExists($userId, $categorieId) { 
        if (!$this->findRow($userId, $categorieId)) { 
            $this->createRow($userId, $categorieId); 
        } 
    }

    public function getPropositionStatus($userId, $categorieId) { 
        $this->ensureRowExists($userId, $categorieId); 
        $row = $this->findRow($userId, $categorieId); 
        return (bool)$row['aPropose']; 
    } 
    
    public function getVoteStatus($userId, $categorieId) { 
        $this->ensureRowExists($userId, $categorieId); 
        $row = $this->findRow($userId, $categorieId); 
        return (bool)$row['aVote']; 
    }

    public function setPropositionStatus($userId, $categorieId) { 
        $this->ensureRowExists($userId, $categorieId); 
        $sql = "UPDATE user_categorie_status 
                SET aPropose = 1 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    } 
    
    public function setVoteStatus($userId, $categorieId) { 
        $this->ensureRowExists($userId, $categorieId); 
        $sql = "UPDATE user_categorie_status 
                SET aVote = 1 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    }
}
