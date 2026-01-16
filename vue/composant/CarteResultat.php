<?php
namespace vue\composant;

require_once 'vue/composant/Composant.php';
require_once 'model/PropositionItem.php';
require_once 'model/Resultat.php';

use model\PropositionItem;
use model\Resultat;

class CarteResultat extends Composant {
    private PropositionItem $proposition;
    private  Resultat $resultat;
    private int $categorieId;

    public function __construct(Resultat $resultat, int $categorieId) {
        $classe = "carte carte-resultat"; 
        
        if ($resultat->getRang() === 1) { 
            $classe .= " gagnant"; 
        } 
        
        parent::__construct($classe);
        
        $this->proposition = $resultat->getProposition();
        $this->resultat = $resultat;
        $this->categorieId = $categorieId;
    }

    protected function renderContent() {
        ?>
            <img src="<?php echo $this->proposition->getImage(); ?>" alt="">
            <h3><?php echo $this->proposition->getTitre(); ?></h3>
            <p><?php echo $this->proposition->getArtiste(); ?></p>

            <h3><?php echo "Rang: " . $this->resultat->getRang(); ?></h3>
            <p><?php echo "Nombre de votes: " . $this->resultat->getNbVote(); ?></p>
        <?php
    }
}
