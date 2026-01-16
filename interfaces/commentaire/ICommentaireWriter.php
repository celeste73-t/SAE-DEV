<?php
namespace interfaces\commentaire;

require_once 'model/Commentaire.php';

use model\Commentaire;

interface ICommentaireWriter {
    public function createCommentaire(Commentaire $commentaire, int $utilisateurId, ?int $postId, ?int $commentaireId): void;
}