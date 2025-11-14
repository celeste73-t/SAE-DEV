<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageConnexion extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            
        </section>
        <?php
    }
}

// Utilisation
$page = new PageConnexion("Connexion");
?>