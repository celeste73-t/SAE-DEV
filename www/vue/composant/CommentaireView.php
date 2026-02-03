<?php
namespace vue\composant;

require_once 'vue/composant/Composant.php';
require_once 'model/Commentaire.php';
require_once 'service/SessionManager.php';

use model\Commentaire;
use service\SessionManager;

class CommentaireView extends Composant{
    private Commentaire $commentaire;
    private string $auteur;
    private array $commentaires;

    public function __construct(Commentaire $commentaire, string $auteur, array $commentaires){
        $this->commentaire = $commentaire;
        $this->auteur = $auteur;
        $this->commentaires = $commentaires;
        parent::__construct("commentaire");
    }
    
    protected function renderContent() {
        $session = SessionManager::getInstance()
        ?>
        <div class="commentaire-header">
            <strong><?php echo $this->auteur ?></strong>
        </div>

        <p><?php echo $this->commentaire->getContenu() ?></p>
        <form action="index.php?page=commentaire&action=create" method="POST" class="form-commentaire">
            <input type="hidden" name="commentaireId" value="<?= $this->commentaire->getId() ?>">
            <input type="hidden" name="userId" value="<?= 
            $session->getUser()->getId() ?>">

            <label>Comment</label>
            <input type="text" name="contenu" required>

            <button type="submit">Publier</button>
        </form>
        <?php 
        foreach ($this->commentaires as $commentaire) {
            $commentaire->render();
        }
    }
}
