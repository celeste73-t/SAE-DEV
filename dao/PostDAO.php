<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/Post.php';

use dao\DAO;
use model\Post;

class PostDAO extends DAO {
    public function createPost(Post $post, int $propositionId) {
        $sql = "INSERT INTO Post (titre, contenu, propositionId) VALUES (?, ?, ?)"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$post->getTitre(), $post->getContenu(), $propositionId]);
    }
}
