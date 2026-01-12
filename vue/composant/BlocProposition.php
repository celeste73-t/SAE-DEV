<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../service/Enum.php';

use service\CategorieType;

class BlocProposition extends Composant {
    private $proposition;
    private $categorie;

    public function __construct($proposition, $categorie) {
        parent::__construct("blocProposition");
        $this->proposition = $proposition;
        $this->categorie = $categorie;
    }

    protected function renderContent() {
        ?>
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
        ";?>
        <?php
    }
}