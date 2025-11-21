<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';

class Header extends Composant {
    public function render() {
        ?>
        <header>
            <a href="?page=accueil"><img src="vue/images/logo.png" alt="Logo"></a>
            <nav>
                <ul>
                    <li><a href="?page=connexion">Connexion</a></li>
                    <li><a href="?page=contact">Contact</a></li>
                    <li><a href="?page=aPropos">À propos</a></li>
                </ul>
            </nav>
        </header>
        <?php
    }
}
?>