<?php
namespace controller\composant;

require_once __DIR__ . '/../../dao/PostDAO.php';
require_once __DIR__ . '/../../model/Post.php';
require_once __DIR__ . '/../../vue/composant/PostView.php';

use dao\PostDAO;
use model\Post;
use vue\composant\PostView;

class PostController {
    private $post;
    private $auteur;

    public function __construct(Post $post, string $auteur) {
        $this->post = $post;
        $this->auteur = $auteur;
    }

    public function build() {
        return new PostView($this->post, $this->auteur);
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
