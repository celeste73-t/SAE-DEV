<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/../../service/Enum.php';

use service\PhaseVote;

class PageCandidat extends Page {
    private array $propositions;
    private $phase;

    public function __construct($title, $phase, array $propositions) {
        $this->propositions = $propositions;
        $this->phase = $phase;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Espace Candidat</h2>
            
            <?php
            if ($this->phase === PhaseVote::Vote2) {
                ?><p>Les propositions nominées vous concernant:</p><?php
                
            } else {
                ?><p>Veuillez revenir en période de vote.</p><?php
            }
            ?>
        </section>
        <?php
    }
}
