<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageProposition extends Page {
    private $proposition;

    public function __construct($title, $proposition) {
        $this->proposition = $proposition;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            
            
        </section>
        <?php
    }
}
