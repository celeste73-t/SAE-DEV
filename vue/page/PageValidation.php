<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../model/PropositionItem.php';
require_once __DIR__ . '/../../service/Enum.php';

use model\PropositionItem;
use service\CategorieType;
use service\PhaseVote;

class PageValidation extends Page {
    private $proposition;
    private $categorie;
    private $phase;

    public function __construct($title, $proposition, $categorie, $phase) {
        $this->proposition = $proposition;
        $this->categorie = $categorie;
        $this->phase = $phase;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h3><?php echo $this->categorie->getNom(); ?></h3>
            <?php echo "
                <iframe title=\"deezer-widget\" 
                src=\"https://widget.deezer.com/widget/dark/" 
                    . $this->categorie->getType()->value
                    . "/" 
                    . $this->proposition->getIdDeezer() 
                    . ( $this->categorie->getType() === CategorieType::Artist ? "/top_tracks" : "" ) 
                    . "?tracklist=false\" 
                width=\"400\" 
                height=\"300\" 
                frameborder=\"0\" 
                allowtransparency=\"true\" 
                allow=\"encrypted-media; 
                clipboard-write\"></iframe>
            "; 
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
