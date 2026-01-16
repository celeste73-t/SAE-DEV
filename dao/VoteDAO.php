<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/PropositionItem.php';

use dao\DAO;
use model\PropositionItem;

class VoteDAO extends DAO {
    public function addVote(PropositionItem $proposition) {
        $propositionDAO = new PropositionDAO();

        $item = $propositionDAO->findPropositionByDeezerId($proposition->getIdDeezer());
        if ($item) {
            $itemId = $item['id'];
        } else {
            $itemId = $this->createItem($proposition);
        }
        $sql = "INSERT INTO vote (propositionId, dateVote) 
                VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$itemId, date('Y-m-d H:i:s')]);
    }


    public function addProposition(PropositionItem $proposition, int $categorieId): void {
        $item = $this->findItem($proposition->getIdDeezer());
        if ($item) {
            $itemId = $item['id'];
        } else {
            $itemId = $this->createItem($proposition);
        }

        $sql = "INSERT INTO proposition (itemId, categorieId, dateProposition) 
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$itemId, $categorieId, date('Y-m-d H:i:s')]);

        return;
    }
}