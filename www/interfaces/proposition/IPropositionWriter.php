<?php
namespace interfaces\proposition;

require_once 'model/PropositionItem.php';

use model\PropositionItem;

interface IPropositionWriter {
    public function addProposition(PropositionItem $proposition, int $categorieId): void;
}