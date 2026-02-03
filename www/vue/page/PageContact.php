<?php
namespace vue\page;

require_once 'vue/page/Page.php';

class PageContact extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Contact</h2>
            <p>Contenu de votre page</p>
        </section>
        <?php
    }
}
