<?php
namespace model;

require_once __DIR__ . '/PropositionItem.php';

use model\PropositionItem;

class Resultat {
    private PropositionItem $proposition;
    private int $nbVote;
    private int $rang;

    public function __construct(PropositionItem $proposition, int $nbVote, int $rang) {
        $this->proposition = $proposition;
        $this->nbVote = $nbVote;
        $this->rang = $rang;
    }

    public function getProposition(): PropositionItem {
        return $this->proposition;
    }

    public function getNbVote(): int {
        return $this->nbVote;
    }

    public function getRang(): int {
        return $this->rang;
    }
}
