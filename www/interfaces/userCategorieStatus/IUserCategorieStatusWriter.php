<?php
namespace interfaces\userCategorieStatus;

interface IUserCategorieStatusWriter {
    public function setPropositionStatus($userId, $categorieId): void;
    public function setVoteStatus($userId, $categorieId): void;
}