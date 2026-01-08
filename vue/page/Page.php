<?php
namespace vue\page;

require_once __DIR__ . '/../composant/Footer.php';
require_once __DIR__ . '/../composant/Header.php';
require_once __DIR__ . '/../../service/SessionManager.php';

use service\UserRole;
use service\PhaseVote;
use service\SessionManager;
use vue\composant\Header;
use vue\composant\Footer;

abstract class Page {
    protected $title = "Page";
    protected $content;
    protected SessionManager $session;


    public function __construct($title = "Page") {
        $this->title = "TopTracks - " . $title;
        $this->session = SessionManager::getInstance();
    }

    protected function renderHeader() {
        $header = new Header();
        $header->render();
    }

    protected function renderFooter() {
        $footer = new Footer();
        $footer->render();
    }

    protected function renderMessage() {
        $session = SessionManager::getInstance();
        $successMessage = $session->getSuccessMessage();
        $errorMessage = $session->getErrorMessage();
        if ($successMessage) {
            echo '<div class="message success-message">' . htmlspecialchars($successMessage) . '</div>';
        }
        if ($errorMessage) {
            echo '<div class="message error-message">' . htmlspecialchars($errorMessage) . '</div>';
        }
    }
 
    abstract protected function renderContent();

    public function render() {
        ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo $this->title; ?></title>
                <link rel="stylesheet" href="./vue/style/style.css">

                <script src="./vue/script/app.js" defer></script>

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
            </head>
            <body>
        <?php
        $this->renderHeader();
        $this->renderContent();
        $this->renderMessage();
        $this->renderFooter();
        ?>
            </body>
            </html>
        <?php
    }
}
