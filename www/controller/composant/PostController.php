<?php
namespace controller\composant;

require_once 'vue/composant/PostView.php';
require_once 'controller/composant/CommentaireController.php';
require_once 'model/Post.php';
require_once 'interfaces/post/IPostWriter.php';
require_once 'interfaces/commentaire/ICommentaireReader.php';
require_once 'interfaces/commentaire/ICommentaireWriter.php';

use controller\composant\CommentaireController;
use model\Post;
use vue\composant\PostView;
use interfaces\post\IPostWriter;
use interfaces\commentaire\ICommentaireReader;
use interfaces\commentaire\ICommentaireWriter;

class PostController {
    private IPostWriter $postWriter;
    private ICommentaireReader $commentaireReader;
    private ICommentaireWriter $commentaireWriter;

    public function __construct(IPostWriter $postWriter, ICommentaireReader $commentaireReader, ICommentaireWriter $commentaireWriter) {
        $this->postWriter = $postWriter;
        $this->commentaireReader = $commentaireReader;
        $this->commentaireWriter = $commentaireWriter;
    }

    public function build(Post $post, string $auteur) {
        $commentairesData = $this->commentaireReader->getCommentaireByPostId($post->getId());
        
        $commentairesViews = []; 
        foreach ($commentairesData as $row) { 
            $postController = new CommentaireController($this->commentaireReader, $this->commentaireWriter);
            $commentairesViews[] =  $postController->build($row['commentaire'],   $row['auteur']);
        }
        return new PostView($post, $auteur, $commentairesViews);
    }

    public function create() {
        $titre = $_POST['titre'] ?? ''; 
        $contenu = $_POST['contenu'] ?? ''; 
        $propositionId = $_POST['propositionId'] ?? '';

        $post = new Post(null, $titre, $contenu);

        $this->postWriter->createPost($post, $propositionId); 
        header("Location: index.php?page=validation"); 
        exit;
    }
}
