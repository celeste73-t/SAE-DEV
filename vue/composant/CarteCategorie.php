<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../service/Enum.php';

use service\PhaseVote;
use vue\composant\Composant;

class CarteCategorie extends Composant {
    private $phase;
    private $categorie;

    public function __construct($phase, $categorie) {
        parent::__construct("carte carte-categorie");
        $this->phase = $phase;
        $this->categorie = $categorie;
    }

    protected function renderContent() {
        echo '<a href="' . $this->getUrl() . '">';
        ?>
            <h3><?php echo $this->categorie->getNom(); ?></h3>
            <p><?php echo $this->categorie->getDescription(); ?></p>
            </a>
        <?php
    }

    private function getUrl() {
        switch ($this->phase) {
            case PhaseVote::Vote1:
                return "?page=proposition&categorie=" . $this->categorie->getId();
            case PhaseVote::Vote2:
                return "?page=vote&categorie=" . $this->categorie->getId();
            case PhaseVote::Resultats:
                return "?page=resultats&categorie=" . $this->categorie->getId();
            default:
                return "#";
        }
    }
}