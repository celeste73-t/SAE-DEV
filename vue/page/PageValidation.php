<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../model/PropositionItem.php';
require_once __DIR__ . '/../../service/Enum.php';


use service\PhaseVote;

class PageValidation extends Page {
    private $blocProposition;
    private $categorie;
    private $phase;

    public function __construct($title, $blocProposition, $categorie, $phase) {
        $this->blocProposition = $blocProposition;
        $this->categorie = $categorie;
        $this->phase = $phase;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <?php
            $this->blocProposition->render();
            if ($this->phase === PhaseVote::Vote1) {
                ?><a href="?page=proposition&categorie=<?php echo $this->categorie->getId(); ?>">Annuler</a> <?php
            } else if ($this->phase === PhaseVote::Vote2) {
                ?><a href="?page=vote&categorie=<?php echo $this->categorie->getId(); ?>">Annuler</a> <?php
            }
            ?>
            <a href="?page=validation&action=validate">Valider</a>
        </section>
        <?php
    }
}
