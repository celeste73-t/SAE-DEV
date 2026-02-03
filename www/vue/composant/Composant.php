<?php
namespace vue\composant;

abstract class Composant {
    protected string $className;

    public function __construct(string $className = "composant") {
        $this->className = $className;
    }

    abstract protected function renderContent();

    public function render() {
        echo "<div class='{$this->className}'>";
        $this->renderContent();
        echo "</div>";
    }
}
