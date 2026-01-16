<?php
namespace interfaces\vote;

require_once 'model/PropositionItem.php';

use model\PropositionItem;

interface IVoteReader {
    public function addVote(PropositionItem $proposition): void;
    public function addProposition(PropositionItem $proposition, int $categorieId): void;
}