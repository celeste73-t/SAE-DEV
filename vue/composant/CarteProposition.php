<?php
namespace vue\composant;

require_once __DIR__ . '/../../model/PropositionItem.php';
require_once __DIR__ . '/Composant.php';

use model\PropositionItem;
use vue\composant\Composant;

class CarteProposition extends Composant {
    private PropositionItem $proposition;

    public function __construct(PropositionItem $proposition) {
        parent::__construct("carte carte-proposition");
        $this->proposition = $proposition;
    }

    protected function renderContent() {
        echo '<a href="' . $this->getUrl() . '">';
        ?>
            <h3><?php echo $this->proposition->getTitre(); ?></h3>
            </a>
        <?php
    }

    private function getUrl() {
        return "#"; // Placeholder URL, modify as needed
    }
}
