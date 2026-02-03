<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/Post.php';
require_once 'interfaces/post/IPostReader.php';
require_once 'interfaces/post/IPostWriter.php';

use PDO;
use dao\DAO;
use model\Post;
use interfaces\post\IPostReader;
use interfaces\post\IPostWriter;

class PostDAO extends DAO implements IPostReader, IPostWriter {

    // Read

    public function getPostByPropositionId(int $propositionId): array {
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

    // Write

    public function createPost(Post $post, int $propositionId): void {
        $sql = "INSERT INTO Post (titre, contenu, propositionId) VALUES (?, ?, ?)"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$post->getTitre(), $post->getContenu(), $propositionId]);
    }
}
