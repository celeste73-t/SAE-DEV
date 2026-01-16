<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/Commentaire.php';

use dao\DAO;
use PDO;
use model\Commentaire;

class CommentaireDAO extends DAO {
    public function createCommentaire(Commentaire $commentaire, int $utilisateurId, ?int $postId, ?int $commentaireId) {
        $sql = "INSERT INTO commentaire (contenu, utilisateurId, postId, commentaireId) 
                VALUES (?, ?, ?, ?)"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$commentaire->getContenu(), $utilisateurId, $postId, $commentaireId]);
    }

    public function getCommentaireByPostId(int $postId) {
        $sql = "SELECT c.id, c.contenu, u.nom AS auteur 
                FROM commentaire c 
                JOIN utilisateur u ON c.utilisateurId = u.id 
                WHERE c.postId = ? AND c.commentaireId IS NULL";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $result[] = [ 
                "commentaire" => new Commentaire($row['id'], $row['contenu']), 
                "auteur" => $row['auteur'] 
            ];
        }

        return $result;
    }

    public function getReponses(int $commentaireId): array { 
        $sql = "SELECT c.id, c.contenu, u.nom AS auteur
                FROM commentaire c
                JOIN utilisateur u ON c.utilisateurId = u.id
                WHERE c.commentaireId = ?
                ORDER BY c.id ASC"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$commentaireId]); 
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = []; 
        foreach ($rows as $row) { 
            $result[] = [ 
                "commentaire" => new Commentaire($row['id'], $row['contenu']), 
                "auteur" => $row['auteur'] 
            ];
        }
        
        return $result; 
    }
}
