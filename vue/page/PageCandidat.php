<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageCandidat extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            
        </section>
        <?php
    }
}

// Utilisation
$page = new PageCandidat("Candidat");
?>