<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/PropositionItem.php';
require_once 'model/Resultat.php';
require_once 'interfaces/resultat/IResultatReader.php';
require_once 'interfaces/resultat/IResultatWriter.php';

use dao\DAO;
use interfaces\resultat\IResultatReader;
use interfaces\resultat\IResultatWriter;
use PDO;
use model\PropositionItem;
use model\Resultat;

class ResultatDAO extends DAO implements IResultatReader, IResultatWriter{

    // Read

    public function getResultat(int $categorieId) : array {
        $sql = "SELECT p.itemId, COUNT(v.id) AS nbVote 
                FROM vote v 
                JOIN proposition p ON v.propositionId = p.id 
                WHERE p.categorieId = ? 
                GROUP BY p.itemId 
                ORDER BY nbVote DESC
                LIMIT 5;";
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
                $itemData['id'],
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

    // Write

    public function archiveResultat(Resultat $resultat, int $categorieId, int $editionId): int {
        $sql = "INSERT INTO resultat (nbVotes, rang, editionId, itemId, categorieId) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$resultat->getNbVote(),
                        $resultat->getRang(), 
                        $resultat->getProposition()->getId(), 
                        $categorieId]);
        return $this->db->lastInsertId();
    }
}