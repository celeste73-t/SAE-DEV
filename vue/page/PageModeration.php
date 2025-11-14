<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageModeration extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            
        </section>
        <?php
    }
}

// Utilisation
$page = new PageModeration("Moderation");
?>