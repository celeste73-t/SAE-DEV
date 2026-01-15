<?php
namespace controller\composant;

require_once __DIR__ . '/../../dao/PostDAO.php';
require_once __DIR__ . '/../../dao/CommentaireDAO.php';
require_once __DIR__ . '/../../controller/composant/CommentaireController.php';
require_once __DIR__ . '/../../model/Post.php';
require_once __DIR__ . '/../../vue/composant/PostView.php';

use dao\PostDAO;
use dao\CommentaireDAO;
use controller\composant\CommentaireController;
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
        $commentaireDAO = new CommentaireDAO(); 
        $commentairesData = $commentaireDAO->getCommentaireByPostId($this->post->getId());
        
        $commentairesViews = []; 
        foreach ($commentairesData as $row) { 
            $postController = new CommentaireController($row['commentaire'],   $row['auteur']);
            $commentairesViews[] =  $postController->build();
        }
        return new PostView($this->post, $this->auteur, $commentairesViews);
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
