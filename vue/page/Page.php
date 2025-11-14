<?php
namespace vue\page;

abstract class Page {
    protected $title = "Page";
    protected $content;
    
    public function __construct($title = "Page") {
        $this->title = $title;
    }

    protected function renderHeader() {
        require_once __DIR__ . '/../composant/Header.php';
    }

    protected function renderFooter() {
        require_once __DIR__ . '/../composant/Footer.php';
    }
 
    abstract protected function renderContent();

    public function render() {
        $this->renderHeader();
        $this->renderContent();
        $this->renderFooter();
    }
}
?>