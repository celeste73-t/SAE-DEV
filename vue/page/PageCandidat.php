<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageCandidat extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Espace Candidat</h2>
            <p>Contenu de votre page</p>
        </section>
        <?php
    }
}
