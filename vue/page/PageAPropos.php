<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageAPropos extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            <h2>A propos</h2>
            <p>Contenu de votre page</p>
        </section>
        <?php
    }
}

// Utilisation
$page = new PageAPropos("À Propos");
?>