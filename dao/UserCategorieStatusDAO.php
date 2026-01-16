<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'interfaces/userCategorieStatus/IUserCategorieStatusReader.php';
require_once 'interfaces/userCategorieStatus/IUserCategorieStatusWriter.php';

use dao\DAO;
use interfaces\userCategorieStatus\IUserCategorieStatusReader;
use interfaces\userCategorieStatus\IUserCategorieStatusWriter;

class UserCategorieStatusDAO extends DAO implements IUserCategorieStatusReader, IUserCategorieStatusWriter {

    // Read

    public function getPropositionStatus($userId, $categorieId): bool { 
        $this->ensureRowExists($userId, $categorieId); 
        $row = $this->findRow($userId, $categorieId); 
        return (bool)$row['aPropose']; 
    } 
    
    public function getVoteStatus($userId, $categorieId): bool { 
        $this->ensureRowExists($userId, $categorieId); 
        $row = $this->findRow($userId, $categorieId); 
        return (bool)$row['aVote']; 
    }

    // Write

    public function setPropositionStatus($userId, $categorieId): void { 
        $this->ensureRowExists($userId, $categorieId); 
        $sql = "UPDATE statut_user_categorie 
                SET aPropose = 1 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    }
    
    public function setVoteStatus($userId, $categorieId): void { 
        $this->ensureRowExists($userId, $categorieId); 
        $sql = "UPDATE statut_user_categorie 
                SET aVote = 1 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    }

    // Private

    private function findRow($userId, $categorieId): array { 
        $sql = "SELECT * 
                FROM statut_user_categorie 
                WHERE utilisateurId = ? AND categorieId = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
        return $stmt->fetch(\PDO::FETCH_ASSOC); 
    } 

    private function createRow($userId, $categorieId): void { 
        $sql = "INSERT INTO statut_user_categorie (utilisateurId, categorieId, aPropose, aVote) 
                VALUES (?, ?, 0, 0)"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$userId, $categorieId]); 
    } 
    
    private function ensureRowExists($userId, $categorieId): void { 
        if (!$this->findRow($userId, $categorieId)) { 
            $this->createRow($userId, $categorieId); 
        } 
    }
}
