<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageVote extends Page {
    private $categorie;

    public function __construct($title, $categorie) {
        $this->categorie = $categorie;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h3>Vote</h3>
            <h4>Catégorie sélectionnée : <?php echo htmlspecialchars($this->categorie->getNom()); ?></h4>
            <p><?php echo htmlspecialchars($this->categorie->getDescription()); ?></p>
        </section>
        <?php
    }
}
