<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../service/Enum.php';
require_once __DIR__ . '/../composant/carteCandidat.php';
require_once __DIR__ . '/../../model/Categorie.php';

use service\PhaseVote;
use vue\composant\carteCandidat;
use model\Categorie;

class PageCandidat extends Page {
    private PhaseVote $phase;
    private array $propositions;
    private array $categories;

    public function __construct(string $title,
                                PhaseVote $phase,
                                array $propositions,
                                array $categories) {
        $this->phase = $phase;
        $this->propositions = $propositions;
        $this->categories = $categories;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Espace Candidat</h2>
            
            <?php
            if ($this->phase === PhaseVote::Vote2) {
                ?><p>Les propositions nominées vous concernant:</p>
                <div class="cartes-conteneur"><?php
                foreach ($this->propositions as $index => $propositionItem) { 
                    $categorie = $this->categories[$index]; 
                    
                    $carte = new carteCandidat($propositionItem, $categorie); 
                    $carte->render(); }
                ?></div><?php
            } else {
                ?><p>Veuillez revenir en période de vote.</p><?php
            }
            ?>
        </section>
        <?php
    }
}
