<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../model/PropositionItem.php';
require_once __DIR__ . '/../../service/Enum.php';
require_once __DIR__ . '/../../service/SessionManager.php';


use service\PhaseVote;
use service\SessionManager;

class PageValidation extends Page {
    private $blocProposition;
    private $blocInteraction;
    private $categorie;
    private $phase;

    public function __construct($title, $blocProposition, $blocInteraction, $categorie, $phase) {
        $this->blocProposition = $blocProposition;
        $this->blocInteraction = $blocInteraction;
        $this->categorie = $categorie;
        $this->phase = $phase;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <?php
            $this->blocProposition->render();
            if (!SessionManager::getInstance()->isCandidat()) {
                if ($this->phase === PhaseVote::Vote1) {
                    ?><a href="?page=proposition&categorie=<?php echo $this->categorie->getId(); ?>">Annuler</a> <?php
                } else if ($this->phase === PhaseVote::Vote2) {
                    ?><a href="?page=vote&categorie=<?php echo $this->categorie->getId(); ?>">Annuler</a> <?php
                }
                echo '<a href="?page=validation&action=validate">Valider</a>';
            }
            if ($this->phase === PhaseVote::Vote2) {
                $this->blocInteraction->render();
            }
            ?>
        </section>
        <?php
    }
}
