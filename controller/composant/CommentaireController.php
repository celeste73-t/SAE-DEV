<?php
namespace controller\composant;

require_once 'vue/composant/CommentaireView.php';
require_once 'model/Commentaire.php';
require_once 'interfaces/commentaire/ICommentaireReader.php';
require_once 'interfaces/commentaire/ICommentaireWriter.php';

use model\Commentaire;
use vue\composant\CommentaireView;
use interfaces\commentaire\ICommentaireReader;
use interfaces\commentaire\ICommentaireWriter;

class CommentaireController {
    private ICommentaireReader $commentaireReader;
    private ICommentaireWriter $commentaireWriter;

    public function __construct(ICommentaireReader $commentaireReader, ICommentaireWriter $commentaireWriter) {
        $this->commentaireReader = $commentaireReader;
        $this->commentaireWriter = $commentaireWriter;
    }

    public function build(Commentaire $commentaire, string $auteur) {
        $commentairesData = $this->commentaireReader->getReponses($commentaire->getId());
        
        $commentairesViews = []; 
        foreach ($commentairesData as $row) { 
            $postController = new CommentaireController($this->commentaireReader, $this->commentaireWriter);
            $commentairesViews[] =  $postController->build($row['commentaire'],   $row['auteur']);
        }
        return new CommentaireView($commentaire, $auteur, $commentairesViews);
    }

    public function create() {
        $contenu = $_POST['contenu'] ?? ''; 
        $userId = $_POST['userId'];
        $postId = $_POST['postId'] ?? null;
        $commentaireId = $_POST['commentaireId'] ?? null;

        $commentaire = new Commentaire(null, $contenu);

        if ($postId && !$commentaireId) { 
            $this->commentaireWriter->createCommentaire($commentaire, $userId, $postId, null); 
        } 
        
        if ($commentaireId) { 
            $this->commentaireWriter->createCommentaire($commentaire, $userId, null, $commentaireId); 
        }
        header("Location: index.php?page=validation"); 
        exit;
    }
}
 