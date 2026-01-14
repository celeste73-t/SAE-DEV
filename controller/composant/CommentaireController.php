<?php
namespace controller\composant;

require_once __DIR__ . '/../../dao/CommentaireDAO.php';
require_once __DIR__ . '/../../model/Commentaire.php';


use dao\CommentaireDAO;
use model\Commentaire;

class CommentaireController {
    public function create() {
        $contenu = $_POST['contenu'] ?? ''; 
        $userId = $_POST['userId'] ?? '';
        $postId = $_POST['postId'] ?? '';

        $commentaire = new Commentaire(null, $contenu);

        $commentaireDAO = new CommentaireDAO(); 
        $commentaireDAO->createCommentaire($commentaire, $userId, $postId, null); 
        header("Location: index.php?page=validation"); 
        exit;
    }
}
 