<?php
namespace controller\composant;

require_once __DIR__ . '/../../dao/CommentaireDAO.php';
require_once __DIR__ . '/../../model/Commentaire.php';
require_once __DIR__ . '/../../vue/composant/CommentaireView.php';

use dao\CommentaireDAO;
use model\Commentaire;
use vue\composant\CommentaireView;

class CommentaireController {
    private Commentaire $commentaire;
    private string $auteur;

    public function __construct(Commentaire $commentaire, string $auteur) {
        $this->commentaire = $commentaire;
        $this->auteur = $auteur;
    }

    public function build() {
        return new CommentaireView($this->commentaire, $this->auteur);
    }

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
 