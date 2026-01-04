<?php
namespace vue\composant;

abstract class Composant {
    public function __construct() {
    }

    abstract public function render();
}
