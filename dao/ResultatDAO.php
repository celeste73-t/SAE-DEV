<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/PropositionItem.php';
require_once __DIR__ . '/../model/Resultat.php';

use dao\DAO;
use PDO;
use model\PropositionItem;
use model\Resultat;

class ResultatDAO extends DAO {
    public function getResultat(int $categorieId) : array {
        $sql = "SELECT p.itemId, COUNT(v.id) AS nbVote 
                FROM vote v 
                JOIN proposition p ON v.propositionId = p.id 
                WHERE p.categorieId = ? 
                GROUP BY p.itemId 
                ORDER BY nbVote DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categorieId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resultats = []; 
        $rang = 1;

        foreach ($rows as $row) { 
            $sqlItem = "SELECT * FROM proposition_item WHERE id = ?"; 
            $stmtItem = $this->db->prepare($sqlItem); 
            $stmtItem->execute([$row['itemId']]); 
            $itemData = $stmtItem->fetch(PDO::FETCH_ASSOC); 
            
            if (!$itemData) { 
                continue; 
            } 
            
            $item = new PropositionItem( 
                $itemData['deezerId'], 
                $itemData['titre'], 
                $itemData['artist'], 
                $itemData['image'] 
            ); 
            
            $resultats[] = new Resultat( 
                $item, 
                (int)$row['nbVote'], 
                $rang 
            ); 
            $rang++; 
        } 
        return $resultats; 
    }
}