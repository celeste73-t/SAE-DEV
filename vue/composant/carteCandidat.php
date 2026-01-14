<?php
namespace vue\composant;

require_once __DIR__ . '/../../model/PropositionItem.php';
require_once __DIR__ . '/../../model/Categorie.php';
require_once __DIR__ . '/Composant.php';

use model\PropositionItem;
use model\Categorie;
use vue\composant\Composant;

class carteCandidat extends Composant {
    private PropositionItem $proposition;
    private Categorie $categorie;

    public function __construct(PropositionItem $proposition, Categorie $categorie) {
        parent::__construct("carte carte-candidat");
        $this->proposition = $proposition;
        $this->categorie = $categorie;
    }

    protected function renderContent() {
        ?>
            <a href="#" class="detail" data-id="<?= $this->proposition->getIdDeezer() ?>" data-categorie="<?= $this->categorie->getId() ?>">
                <img src="<?php echo $this->proposition->getImage(); ?>" alt="">
                <h3><?php echo $this->proposition->getTitre(); ?></h3>
                <p><?php echo $this->proposition->getArtiste(); ?></p>
                <p><?php echo $this->categorie->getNom(); ?></p>
            </a>
        <?php
    }
}
