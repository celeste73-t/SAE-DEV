<?php
namespace interfaces\userCategorieStatus;

interface IUserCategorieStatusReader {
    public function getPropositionStatus($userId, $categorieId): bool;
    public function getVoteStatus($userId, $categorieId): bool;
}