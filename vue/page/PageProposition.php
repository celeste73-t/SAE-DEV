<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageProposition extends Page {
    private $categorie;

    public function __construct($title = "Connexion", $categorie) {
        $this->categorie = $categorie;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h3>Proposition</h3>
        </section>
        <?php
    }
}
