<?php
namespace interfaces\proposition;

interface IPropositionReader {
    public function findItem(int $deezerId): array;
    public function findPropositionByDeezerId(int $deezerId): array;
    public function getNominatedPropositions($categorieId): array;
    public function getNominatedPropositionsByCandidat(int $userId): array;
}