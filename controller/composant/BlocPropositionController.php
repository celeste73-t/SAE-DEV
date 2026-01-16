<?php
namespace controller\composant;

require_once 'vue/composant/BlocProposition.php';

use vue\composant\BlocProposition;

class BlocPropositionController {
    private $proposition;
    private $categorie;

    public function __construct($proposition, $categorie) {
        $this->proposition = $proposition;
        $this->categorie = $categorie;
    }

    public function build() {
        return new BlocProposition($this->proposition, $this->categorie);
    }
}
 