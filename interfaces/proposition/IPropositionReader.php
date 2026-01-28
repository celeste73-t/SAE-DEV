<?php
namespace interfaces\proposition;

interface IPropositionReader {
    public function findItem(int $deezerId);
    public function findPropositionByDeezerId(int $deezerId);
    public function getNominatedPropositions($categorieId): array;
    public function getNominatedPropositionsByCandidat(int $userId): array;
}