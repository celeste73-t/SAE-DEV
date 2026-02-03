<?php
namespace vue\composant;

require_once 'vue/composant/Composant.php';
require_once 'model/Post.php';
require_once 'service/SessionManager.php';

use model\Post;
use service\SessionManager;

class PostView extends Composant {
    private Post $post;
    private string $auteur;
    private $commentaires;
    
    public function __construct(Post $post, string $auteur, array $commentaires) {
        $this->post = $post;
        $this->auteur = $auteur;
        $this->commentaires = $commentaires;
        parent::__construct("post");
    }

    protected function renderContent() {
        $session = SessionManager::getInstance()
        ?>
        <div class="post-header">
            <strong><?php echo $this->auteur ?></strong>
        </div>

        <h3><?php echo $this->post->getTitre() ?></h3>

        <p><?php echo $this->post->getContenu() ?></p>
        <?php if ($session->isLogged()) {
        ?>
        <form action="index.php?page=commentaire&action=create" method="POST" class="form-post">
            <input type="hidden" name="postId" value="<?= $this->post->getId() ?>">
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
}
