<?php
namespace vue\page;

abstract class Page {
    protected $title = "Page";
    protected $content;
    
    public function __construct($title = "Page") {
        $this->title = "TopTracks - " . $title;
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
        ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo $this->title; ?></title>
                <link rel="stylesheet" href="../style/page.css">

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
            </head>
            <body>
        <?php
        $this->renderHeader();
        $this->renderContent();
        $this->renderFooter();
        ?>
            </body>
            </html>
        <?php
    }
}
?>