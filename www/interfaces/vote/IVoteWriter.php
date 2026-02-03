<?php
namespace interfaces\vote;

require_once 'model/PropositionItem.php';

use model\PropositionItem;

interface IVoteWriter {
    public function addVote(PropositionItem $proposition): void;
}