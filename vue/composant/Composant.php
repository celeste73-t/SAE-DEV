<?php
namespace vue\composant;

abstract class Composant {
    public function __construct() {
        $this->render();
    }

    abstract public function render();
}
?>