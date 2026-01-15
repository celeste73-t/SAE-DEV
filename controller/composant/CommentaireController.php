<?php
namespace controller\composant;

require_once __DIR__ . '/../../dao/CommentaireDAO.php';
require_once __DIR__ . '/../../model/Commentaire.php';
require_once __DIR__ . '/../../vue/composant/CommentaireView.php';

use dao\CommentaireDAO;
use model\Commentaire;
use vue\composant\CommentaireView;

class CommentaireController {

    public function build(Commentaire $commentaire, string $auteur) {
        $commentaireDAO = new CommentaireDAO(); 
        $commentairesData = $commentaireDAO->getReponses($commentaire->getId());
        
        $commentairesViews = []; 
        foreach ($commentairesData as $row) { 
            $postController = new CommentaireController();
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

        $commentaireDAO = new CommentaireDAO(); 
        if ($postId && !$commentaireId) { 
            $commentaireDAO->createCommentaire($commentaire, $userId, $postId, null); 
        } 
        
        if ($commentaireId) { 
            $commentaireDAO->createCommentaire($commentaire, $userId, null, $commentaireId); 
        }
        header("Location: index.php?page=validation"); 
        exit;
    }
}
 