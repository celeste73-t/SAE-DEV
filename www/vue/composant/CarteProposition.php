<?php
namespace vue\composant;

require_once 'vue/composant/Composant.php';
require_once 'model/PropositionItem.php';

use model\PropositionItem;

class CarteProposition extends Composant {
    private PropositionItem $proposition;
    private int $categorieId;

    public function __construct(PropositionItem $proposition, int $categorieId) {
        parent::__construct("carte carte-proposition");
        $this->proposition = $proposition;
        $this->categorieId = $categorieId;
    }

    protected function renderContent() {
        ?>
            <a href="#" class="vote" data-id="<?= $this->proposition->getIdDeezer() ?>" data-categorie="<?= $this->categorieId ?>">
                <img src="<?php echo $this->proposition->getImage(); ?>" alt="">
                <h3><?php echo $this->proposition->getTitre(); ?></h3>
                <p><?php echo $this->proposition->getArtiste(); ?></p>
            </a>
        <?php
    }
}
