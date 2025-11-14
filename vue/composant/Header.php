<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';

class Header extends Composant {
    public function render() {
        ?>
        <header>
            <h1>Mon Site Web</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="about.php">À propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </header>
        <?php
    }
}
?>