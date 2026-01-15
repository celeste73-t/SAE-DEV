<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../model/Commentaire.php';
require_once __DIR__ . '/../../service/SessionManager.php';

use model\Commentaire;
use service\SessionManager;

class CommentaireView extends Composant{
    private $commentaire;
    private $auteur;

    public function __construct(Commentaire $commentaire, string $auteur){
        $this->commentaire = $commentaire;
        $this->auteur = $auteur;
        parent::__construct("commentaire");
    }
    
    protected function renderContent() {
        $session = SessionManager::getInstance()
        ?>
        <div class="post-header">
            <strong><?php echo $this->auteur ?></strong>
        </div>

        <p><?php echo $this->commentaire->getContenu() ?></p>
        <?php 
        
    }
}
