<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/Post.php';

use PDO;
use dao\DAO;
use model\Post;

class PostDAO extends DAO {
    public function createPost(Post $post, int $propositionId) {
        $sql = "INSERT INTO Post (titre, contenu, propositionId) VALUES (?, ?, ?)"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$post->getTitre(), $post->getContenu(), $propositionId]);
    }

    public function getPostByPropositionId(int $propositionId) {
        $sql = "SELECT 
                    p.id AS id,
                    p.titre,
                    p.contenu,
                    u.nom AS auteur
                FROM Post p
                JOIN proposition pr ON p.propositionId = pr.id
                JOIN candidat c ON pr.candidatId = c.id
                JOIN utilisateur u ON c.utilisateurId = u.id
                WHERE p.propositionId = ?
                ORDER BY p.id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$propositionId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $item = new Post(
                $row['id'],
                $row['titre'],
                $row['contenu'],
            );

            $result[] = [
                'auteur' => $row['auteur'],
                'post'=> $item
            ];
        }

        return $result;
    }
}
