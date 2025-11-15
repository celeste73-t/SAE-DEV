<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';

class Header extends Composant {
    public function render() {
        ?>
        <header>
            <a href="PageAccueil.php"><img src="../images/logo.png" alt="Logo"></a>
            <nav>
                <ul>
                    <li><a href="PageConnexion.php">Connexion</a></li>
                    <li><a href="PageContact.php">Contact</a></li>
                    <li><a href="PageAPropos.php">À propos</a></li>
                </ul>
            </nav>
        </header>
        <?php
    }
}
?>