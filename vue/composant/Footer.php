<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';

class Footer extends Composant {
    public function render() {
        ?>
        <footer>
            <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
        </footer>
        <?php
    }
}
?>