<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageAccueil extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Bienvenue</h2>
            <p>Contenu de votre page d'accueil</p>
        </section>
        <?php
    }
}

// Utilisation
$page = new PageAccueil("Accueil");
?>