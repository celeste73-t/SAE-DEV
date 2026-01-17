<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/PropositionItem.php';
require_once 'interfaces/vote/IVoteWriter.php';

use dao\DAO;
use interfaces\vote\IVoteWriter;
use model\PropositionItem;

class VoteDAO extends DAO implements IVoteWriter {

    // Write

    public function addVote(PropositionItem $proposition): void {
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
}