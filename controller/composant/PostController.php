<?php
namespace controller\composant;

require_once 'dao/PostDAO.php';
require_once 'dao/CommentaireDAO.php';
require_once 'controller/composant/CommentaireController.php';
require_once 'model/Post.php';
require_once 'vue/composant/PostView.php';

use dao\PostDAO;
use dao\CommentaireDAO;
use controller\composant\CommentaireController;
use model\Post;
use vue\composant\PostView;

class PostController {

    public function build(Post $post, string $auteur) {
        $commentaireDAO = new CommentaireDAO(); 
        $commentairesData = $commentaireDAO->getCommentaireByPostId($post->getId());
        
        $commentairesViews = []; 
        foreach ($commentairesData as $row) { 
            $postController = new CommentaireController();
            $commentairesViews[] =  $postController->build($row['commentaire'],   $row['auteur']);
        }
        return new PostView($post, $auteur, $commentairesViews);
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
