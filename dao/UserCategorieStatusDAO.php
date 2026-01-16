<?php
namespace dao;

require_once 'dao/DAO.php';

use dao\DAO;

class UserCategorieStatusDAO extends DAO {
    private function findRow($userId, $categorieId) { 
        $sql = "SELECT * 
                FROM statut_user_categorie 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
        return $stmt->fetch(\PDO::FETCH_ASSOC); 
    } 
    
    private function createRow($userId, $categorieId) { 
        $sql = "INSERT INTO statut_user_categorie (utilisateurId, categorieId, aPropose, aVote) 
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
        $sql = "UPDATE statut_user_categorie 
                SET aPropose = 1 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    } 
    
    public function setVoteStatus($userId, $categorieId) { 
        $this->ensureRowExists($userId, $categorieId); 
        $sql = "UPDATE statut_user_categorie 
                SET aVote = 1 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    }
}
