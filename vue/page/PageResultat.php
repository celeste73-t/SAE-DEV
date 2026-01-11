<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../model/Categorie.php';
require_once __DIR__ . '/../composant/CarteResultat.php';

use vue\page\Page;
use model\Categorie;
use vue\composant\CarteResultat;

class PageResultat extends Page {
    private $categorie;
    private array $resultats;

    public function __construct($title, Categorie $categorie, array $resultats) {
        $this->categorie = $categorie;
        $this->resultats = $resultats;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h3>Resultat</h3>
            <h4>Catégorie sélectionnée : <?php echo htmlspecialchars($this->categorie->getNom()); ?></h4>
            <p><?php echo htmlspecialchars($this->categorie->getDescription()); ?></p>

            <div class="cartes-conteneur"><?php
                foreach ($this->resultats as $resultat) {
                    $carte = new CarteResultat($resultat, $this->categorie->getId());
                    $carte->render();
                }
            ?></div>
        </section>
        <?php
    }
}
