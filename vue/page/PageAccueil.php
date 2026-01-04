<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../service/Enum.php';

use service\PhaseVote;

class PageAccueil extends Page {
    private PhaseVote $phase;

    public function __construct($title, $phase) {
        parent::__construct($title);
        $this->phase = $phase;
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
        echo "<h3>Catégories de vote :</h3>";
    }
}

?>