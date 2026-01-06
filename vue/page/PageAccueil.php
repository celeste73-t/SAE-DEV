<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../service/Enum.php';
require_once __DIR__ . '/../../model/Categorie.php';
require_once __DIR__ . '/../composant/CarteCategorie.php';

use service\PhaseVote;
use model\Categorie;
use vue\composant\CarteCategorie;

class PageAccueil extends Page {
    private PhaseVote $phase;
    private array $categories;

    public function __construct($title, $phase, $categories) {
        parent::__construct($title);
        $this->phase = $phase;
        $this->categories = $categories;
    }

    protected function renderContent() {
        ?>
        <section class="content">
        <?php
        switch ($this->phase) {
            case PhaseVote::PreVote:
                echo "<h2>Bienvenue sur Toptracks</h2>";
                echo "<p>Le prochaint vote commencera le ...</p>";
                echo '<a href="?page=inscription">Créer un compte pour etre pres à voter</a>';
                break;
            case PhaseVote::Vote1:
                echo "<h2>Phase Vote 1</h2>";
                $this->AfficherCategories();
                break;
            case PhaseVote::Vote2:
                echo "<h2>Phase Vote 2</h2>";
                $this->AfficherCategories();
                break;
            case PhaseVote::Resultats:
                echo "<h2>Résultats</h2>";
                $this->AfficherCategories();
                break;
            default:
                echo "<p>Phase inconnue.</p>";
        }
        ?>
        </section>
        <?php
    }

    private function AfficherCategories() {
        ?><div class="cartes-conteneur"><?php
        foreach ($this->categories as $categorie) {
            $carte = new CarteCategorie();
            $carte->render($this->phase, $categorie);
        }
        ?></div><?php
    }
}
