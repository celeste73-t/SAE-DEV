<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../model/Categorie.php';
require_once __DIR__ . '/../composant/CarteProposition.php';

use model\Categorie;
use vue\page\Page;
use vue\composant\CarteProposition;

class PageVote extends Page {
    private $categorie;
    private array $propositions;

    public function __construct($title, Categorie $categorie, array $propositions) {
        $this->categorie = $categorie;
        $this->propositions = $propositions;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h3>Vote</h3>
            <h4>Catégorie sélectionnée : <?php echo htmlspecialchars($this->categorie->getNom()); ?></h4>
            <p><?php echo htmlspecialchars($this->categorie->getDescription()); ?></p>

            <div class="cartes-conteneur"><?php
                foreach ($this->propositions as $proposition) {
                    $carte = new CarteProposition($proposition, $this->categorie->getId());
                    $carte->render();
                }
            ?></div>
        </section>
        <?php
    }
}
