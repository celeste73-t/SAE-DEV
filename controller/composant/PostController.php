<?php
namespace controller\composant;

require_once __DIR__ . '/../../dao/PostDAO.php';
require_once __DIR__ . '/../../model/Post.php';

use dao\PostDAO;
use model\Post;

class PostController {
    public function __construct() {
    }

    public function build() {

    }

    public function create() {
        $titre = $_POST['titre'] ?? ''; 
        $contenu = $_POST['contenu'] ?? ''; 
        $propositionId = $_POST['propositionId'] ?? '';

        $post = new Post(null, $titre, $contenu);

        $postDAO = new PostDAO(); 
        $postDAO->createPost($post, $propositionId); 
        header("Location: index.php?page=validation"); 
        exit;
    }
}
