<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../service/Enum.php';

use service\PhaseVote;

class CarteCategorie {
    public function render($phase, $categorie) {
        echo '<a href="' . $this->getUrl($phase, $categorie) . '" class="carte-categorie">';
        ?>
            <h3><?php echo $categorie->getNom(); ?></h3>
            <p><?php echo $categorie->getDescription(); ?></p>
            </a>
        <?php
    }

    private function getUrl($phase, $categorie) {
        switch ($phase) {
            case PhaseVote::Vote1:
                return "?page=proposition&categorie=" . $categorie->getId();
            case PhaseVote::Vote2:
                return "?page=vote&categorie=" . $categorie->getId();
            case PhaseVote::Resultats:
                return "?page=resultats&categorie=" . $categorie->getId();
            default:
                return "#";
        }
    }
}