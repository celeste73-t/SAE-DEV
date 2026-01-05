<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageProposition extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            <h3>Proposition</h3>
        </section>
        <?php
    }
}
