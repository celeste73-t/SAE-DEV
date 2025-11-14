<?php
namespace vue\page;

abstract class Page {
    protected $title = "Page";
    protected $content;
    
    public function __construct($title = "Page") {
        $this->title = $title;
        $this->render();
    }

    protected function renderHeader() {
        require_once __DIR__ . '/../composant/Header.php';
        new \vue\composant\Header();
    }

    protected function renderFooter() {
        require_once __DIR__ . '/../composant/Footer.php';
        new \vue\composant\Footer();
    }
 
    abstract protected function renderContent();

    private function render() {
        $this->renderHeader();
        $this->renderContent();
        $this->renderFooter();
    }
}
?>