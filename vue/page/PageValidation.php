<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../model/Proposition.php';

use model\Proposition;

class PageValidation extends Page {
    private $proposition;
    private $categorie;

    public function __construct($title, $proposition, $categorie) {
        $this->proposition = $proposition;
        $this->categorie = $categorie;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h3><?php echo $this->categorie->getNom(); ?></h3>
            <?php echo "
                <iframe title=\"deezer-widget\" 
                src=\"https://widget.deezer.com/widget/dark/" 
                    . $this->proposition->getType() 
                    . "/" 
                    . $this->proposition->getId() 
                    . ( $this->proposition->getType() == "artist" ? "/top_tracks" : "" ) 
                    . "?tracklist=false\" 
                width=\"400\" 
                height=\"300\" 
                frameborder=\"0\" 
                allowtransparency=\"true\" 
                allow=\"encrypted-media; 
                clipboard-write\"></iframe>
            "; ?>
            <a href="?page=proposition&categorie=<?php echo $this->categorie->getId(); ?>">Annuler</a>
            <a href="?page=validation&action=validate">Valider</a>
        </section>
        <?php
    }
}
