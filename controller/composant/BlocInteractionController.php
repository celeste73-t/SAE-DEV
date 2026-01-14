<?php
namespace controller\composant;

require_once __DIR__ . '/../../vue/composant/BlocInteraction.php';

use vue\composant\BlocInteraction;

class BlocInteractionController {
    private $propositionId;

    public function __construct($propositionId) {
        $this->propositionId = $propositionId;
    }

    public function build() {
        return new BlocInteraction($this->propositionId);
    }
}
 