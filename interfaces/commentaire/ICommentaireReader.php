<?php
namespace interfaces\commentaire;

interface ICommentaireReader {
    public function getCommentaireByPostId(int $postId): array;
    public function getReponses(int $commentaireId): array;
}