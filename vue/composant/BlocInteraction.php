<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../service/Enum.php';
require_once __DIR__ . '/../../service/SessionManager.php';

use service\SessionManager;

class BlocInteraction extends Composant {
    private $propositionId;

    public function __construct($propositionId) {
        parent::__construct("blocInteraction");
        $this->propositionId = $propositionId;
    }

    protected function renderContent() {
        echo "proposition: ". $this->propositionId;
        if (SessionManager::getInstance()->isCandidat()){ ?>
                <form action="index.php?page=post&action=create" method="POST" class="form-post">
                    <input type="hidden" name="propositionId" value="<?= $this->propositionId ?>">

                    <label>Titre</label>
                    <input type="text" name="titre" required>

                    <label>Contenu</label>
                    <textarea name="contenu" required></textarea>

                    <button type="submit">Publier</button>
                </form>
            <?php } ?>

            <div class="posts">
                <!-- Ici tu affiches les posts existants -->
            </div>

        </div>
        <?php
    }
}