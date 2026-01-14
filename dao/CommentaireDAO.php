<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/Commentaire.php';

use dao\DAO;
use model\Commentaire;

class CommentaireDAO extends DAO {
    public function createCommentaire(Commentaire $commentaire, int $utilisateurId, ?int $postId, ?int $commentaireId) {
        $sql = "INSERT INTO commentaire (contenu, utilisateurId, postId, commentaireId) 
                VALUES (?, ?, ?, ?)"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$commentaire->getContenu(), $utilisateurId, $postId, $commentaireId]);
    }
}
